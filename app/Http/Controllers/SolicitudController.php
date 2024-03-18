<?php

namespace App\Http\Controllers;

use App\Models\Certificados;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = Solicitud::with('certificados')->where('user_id', auth()->user()->id)->get();
        return view('solicitudes.index', compact('datos'));
    }

    public function indexAdmin()
    {
      $datos = Solicitud::with('certificados')->whereIn('estado', ['Pendiente', 'En curso'])->get()->sortByDesc('updated_at');
        return view('solicitudes.index_admin');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $certificados = Certificados::select('id', 'tipo_certificado', 'mensaje')->get();
        return view('solicitudes.create', compact('certificados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo_documento' => 'required',
            'documento' => 'required|max:20',
            'nombre_completo' => 'required|max:50',
            'telefono' => 'required|max:20',
            'correo' => 'required|email|max:200',
            'observaciones' => 'nullable|max:255',
            'adj_documento' => 'required|mimes:pdf|max:1024|file',
            'adj_estampilla' => 'required|mimes:pdf|max:1024|file',
            'adj_pago' => 'required|mimes:pdf|max:1024|file',
        ]);

        if ($request->hasFile('adj_documento') && $request->hasFile('adj_estampilla') && $request->hasFile('adj_pago')) {
            $adj_documento = 'public/documentos/' . $request->documento . '/documento.' . $request->file('adj_documento')->getClientOriginalExtension();
            $adj_estampilla = 'public/documentos/' . $request->documento . '/estampilla.' . $request->file('adj_estampilla')->getClientOriginalExtension();
            $adj_pago = 'public/documentos/' . $request->documento . '/pago.' . $request->file('adj_pago')->getClientOriginalExtension();
        }

        $solicitud = new Solicitud();

        $datos = $request->only('tipo_documento', 'documento', 'nombre_completo', 'telefono', 'correo', 'observaciones', 'egresado');
        $datos['adj_documento'] = $adj_documento;
        $datos['adj_estampilla'] = $adj_estampilla;
        $datos['adj_pago'] = $adj_pago;
        $datos['estado'] = ('Pendiente');

        $datos['user_id'] = auth()->user()->id;

        $insert = $solicitud->create($datos);

        if ($insert) {
            $request->file('adj_documento')->storeAs('documentos/' . $request->documento, 'documento.' . $request->file('adj_documento')->getClientOriginalExtension(),'public');
            $request->file('adj_estampilla')->storeAs('documentos/' . $request->documento, 'estampilla.' . $request->file('adj_estampilla')->getClientOriginalExtension(), 'public');
            $request->file('adj_pago')->storeAs('documentos/' . $request->documento, 'pago.' . $request->file('adj_pago')->getClientOriginalExtension(), 'public');

            $solicitud_id = $insert->id;

            foreach ($request->tipo_certificado as $certificado) {
                $solicitud->certificados()->attach($certificado, ['solicitud_id' => $solicitud_id, 'estado' => 'Pendiente']);
            }
        }
        return redirect()->route('solicitudes.create')->with('success', 'Solicitud registrada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('solicitudes.showEncrypted', $id);
    }

    public function showEncrypted($encryptedId)
    {
        $id = substr($encryptedId, 10);
        $datos = Solicitud::whereHas('certificados', function ($query) use ($id) {
            $query->where('solicitud_certificado.id', $id);
        })->get();
        return view('solicitudes.show', compact('datos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        // $datos = Solicitud::with('certificados')->where('id', $id)->get();
        $solicitud = Solicitud::find($id);
        $certificados = $solicitud->certificados;
        return view('solicitudes.edit', compact('solicitud', 'certificados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $solicitud_id)
    {
        $solicitud = Solicitud::find($solicitud_id);
        if ($solicitud) {
            $solicitud->estado = $request->estado;
            $solicitud->observacion_uts = $request->observacion_uts;
            $solicitud->updated_at = now();
            $solicitud->save();
            foreach ($request->certificados as $certificado => $certificadoData) {
                $data_update = [
                    'estado' => $certificadoData['estado'],
                    'observaciones' => $certificadoData['observaciones'] ?? null,
                    'user_id' => auth()->user()->id,
                ];

                if (isset($certificadoData['ruta'])) {
                    $certificado_nombre = Certificados::find($certificado)->tipo_certificado;
                    $ruta = 'public/documentos/' . $solicitud->documento . '/enviados/' . $solicitud_id . '-' . $certificado_nombre . '.' . $certificadoData['ruta']->getClientOriginalExtension();
                    $carpeta = 'documentos/' . $solicitud->documento . '/enviados/';
                    Storage::disk('public')->makeDirectory($carpeta, 0755, true);

                    $data_update['ruta'] = $ruta;

                    $update_pivot = $solicitud->certificados()->updateExistingPivot(
                        $certificado,
                        $data_update + ['updated_at' => now()]
                    );

                    $pivotId = $solicitud->certificados()->where('certificado_id', $certificado)->first()->pivot->id;

                    if ($update_pivot) {
                        if (isset($ruta)) {
                            $ruta = $certificadoData['ruta']->storeAs('documentos/' . $solicitud->documento . '/enviados/' . $solicitud_id . '-' . $certificado_nombre . '.' . $certificadoData['ruta']->getClientOriginalExtension(),'public');
                        }
                    }

                    $ruta_pdf_existente = 'storage/documentos/' . $solicitud->documento . '/enviados/' . $solicitud_id . '-' . $certificado_nombre . '.' . $certificadoData['ruta']->getClientOriginalExtension();
                    $ruta_qr = 'storage/documentos/' . $solicitud->documento . '/enviados/' . $solicitud_id . '-' . $certificado_nombre . 'qr.png';

                    // Crear una nueva instancia de FPDI
                    $pdf = new Fpdi();

                    // Establecer el archivo fuente
                    $pdf->setSourceFile($ruta_pdf_existente);

                    //Creacion del Qr y guardarlo como png
                    $randomDigits = mt_rand(1000000000, 9999999999);
                    $encriptado = $randomDigits . $pivotId;

                    // Generar la URL encriptada utilizando el helper route()
                    $url = route('solicitudes.show', ['id' => $encriptado]);
                    $qrCodeURL = $url;
                    $qrCode = new QrCode($qrCodeURL);
                    $writer = new PngWriter();
                    $result = $writer->write($qrCode);
                    $result->saveToFile($ruta_qr);

                    // Agregar la página importada al documento TCPDF
                    $pdf->addPage();
                    $pageId = $pdf->importPage(1);
                    $pdf->useTemplate($pageId);

                    // Coordenadas para posicionar el Qr en el PDF
                    $y = 250;
                    $tamaño_qr = 15;
                    $ancho_pagina = 210;
                    $alto_pagina = 297;
                    $x = $ancho_pagina - $tamaño_qr - 10;
                    $y = $alto_pagina - $tamaño_qr - 10;

                    //Agrego el Qr al PDF y guardo el PDF
                    $pdf->Image($ruta_qr, $x, $y, $tamaño_qr, $tamaño_qr);
                    $pdf->Output($ruta_pdf_existente, 'F');
                }
            }
        }
        return redirect()->route('solicitudes.admin')->with('success', 'Solicitud actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Solicitud $solicitud)
    {
        //
    }

    public function data()
    {
        $datos = Solicitud::with('certificados')->whereIn('estado', ['Pendiente', 'En curso'])->orderBy('updated_at', 'desc')->get();
        return response()->json($datos);
    }
}
