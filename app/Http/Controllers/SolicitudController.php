<?php

namespace App\Http\Controllers;

use App\Models\Certificados;
use App\Models\Solicitud;
use App\Models\SolicitudCertificado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $datos=Solicitud::with('certificados')->where('user_id', auth()->user()->id)->get();
        // dd($datos);
        return view('solicitudes.index');
        $nombreArchivo = 'documento.pdf'; // Reemplaza esto con el nombre real de tu archivo
        $rutaArchivo = 'public/documentos/1098643625/documento.pdf'; // Reemplaza $documento con el valor correcto
        $urlArchivo = asset(Storage::url($rutaArchivo));
        return $urlArchivo;
    }

    public function indexAdmin()
    {
        $datos = Solicitud::with('certificados')->where('estado', 'Pendiente')->get()->sortByDesc('created_at');

        return view('solicitudes.index_admin');

        $nombreArchivo = 'documento.pdf'; // Reemplaza esto con el nombre real de tu archivo
        $rutaArchivo = 'public/documentos/1098643625/documento.pdf'; // Reemplaza $documento con el valor correcto
        $urlArchivo = asset(Storage::url($rutaArchivo));
        return $urlArchivo;
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

        $insert= $solicitud->create($datos);

        if ($insert) {
            $request->file('adj_documento')->storeAs('public/documentos/' . $request->documento, 'documento.' . $request->file('adj_documento')->getClientOriginalExtension());
            $request->file('adj_estampilla')->storeAs('public/documentos/' . $request->documento, 'estampilla.' . $request->file('adj_estampilla')->getClientOriginalExtension());
            $request->file('adj_pago')->storeAs('public/documentos/' . $request->documento, 'pago.' . $request->file('adj_pago')->getClientOriginalExtension());

            $solicitud_id= $insert->id;

            foreach ($request->tipo_certificado as $certificado) {
                $solicitud->certificados()->attach($certificado, ['solicitud_id' => $solicitud_id]);
            }
        }
        return redirect()->route('solicitudes.create')->with('success', 'Solicitud registrada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Solicitud $solicitud)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Solicitud $solicitud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Solicitud $solicitud)
    {
        //
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
        $datos = Solicitud::with('certificados')->where('user_id', auth()->user()->id)->get();
        return response()->json($datos);
    }
}
