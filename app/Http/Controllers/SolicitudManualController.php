<?php
namespace App\Http\Controllers;

use App\Models\Certificados;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\DB;
use App\Mail\CertificadoMail;
use Illuminate\Support\Facades\Mail;

class SolicitudManualController extends Controller
{
   public function create()
   {
      $certificados = Certificados::select('id', 'tipo_certificado', 'mensaje')->get();
      $usuario = auth()->user();
      return view('solicitud-manual.create', compact('certificados'));
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(Request $request)
   {
      dd($request->all());


      // $request->validate([
      //    'tipo_documento' => 'required',
      //    'documento' => 'required|max:20',
      //    'nombre_completo' => 'required|max:50',
      //    'correo' => 'required|email|max:200',
      // ]);

      // if ($request->hasFile('adj_documento') && $request->hasFile('adj_estampilla') && $request->hasFile('adj_pago')) {
      //    $adj_documento = 'documentos/' . $request->documento . '/documento.' . $request->file('adj_documento')->getClientOriginalExtension();
      //    $adj_estampilla = 'documentos/' . $request->documento . '/estampilla.' . $request->file('adj_estampilla')->getClientOriginalExtension();
      //    $adj_pago = 'documentos/' . $request->documento . '/pago.' . $request->file('adj_pago')->getClientOriginalExtension();
      // }

      // $solicitud = new Solicitud();

      // $datos = $request->only('tipo_documento', 'documento', 'nombre_completo', 'telefono', 'correo', 'observaciones', 'egresado');
      // $datos['adj_documento'] = $adj_documento;
      // $datos['adj_estampilla'] = $adj_estampilla;
      // $datos['adj_pago'] = $adj_pago;
      // $datos['estado'] = ('Pendiente');

      // $datos['user_id'] = auth()->user()->id;

      // $insert = $solicitud->create($datos);

      // if ($insert) {
      //    $request->file('adj_documento')->storeAs('documentos/' . $request->documento, 'documento.' . $request->file('adj_documento')->getClientOriginalExtension());
      //    $request->file('adj_estampilla')->storeAs('documentos/' . $request->documento, 'estampilla.' . $request->file('adj_estampilla')->getClientOriginalExtension());
      //    $request->file('adj_pago')->storeAs('documentos/' . $request->documento, 'pago.' . $request->file('adj_pago')->getClientOriginalExtension());

      //    $solicitud_id = $insert->id;

      //    foreach ($request->tipo_certificado as $certificado) {
      //       $solicitud->certificados()->attach($certificado, ['solicitud_id' => $solicitud_id]);
      //    }
      // }
      // return redirect()->route('solicitudes.index')->with('success', 'Solicitud registrada exitosamente.');
   }
   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, $solicitud_id)
   {
      $solicitud = Solicitud::find($solicitud_id);

      if ($solicitud) {
         try {

            DB::beginTransaction();
            $solicitud->estado = $request->estado;
            if ($request->estado == 'Finalizado') {
               $solicitud->edit_adj_documento = 0;
               $solicitud->edit_adj_estampilla = 0;
               $solicitud->edit_adj_pago = 0;
            } else {
               $solicitud->edit_adj_documento = $request->edit_adj_documento;
               $solicitud->edit_adj_estampilla = $request->edit_adj_estampilla;
               $solicitud->edit_adj_pago = $request->edit_adj_pago;
            }
            $solicitud->observacion_uts = $request->observacion_uts;
            $solicitud->updated_at = now();
            $solicitud->user_uts = auth()->user()->id;
            $solicitud->save();
            foreach ($request->certificados as $certificado => $certificadoData) {
               $data_update = [
                  'user_id' => auth()->user()->id,
               ];
               if (isset($certificadoData['ruta'])) {
                  $certificado_nombre = Certificados::find($certificado)->nombre_archivo;
                  $ruta = 'documentos/' . $solicitud->documento . '/enviados/' . $solicitud_id . '-' . $certificado_nombre . '.' . $certificadoData['ruta']->getClientOriginalExtension();


                  $pivotId = $solicitud->certificados()->where('certificado_id', $certificado)->first()->pivot->id;
                  $randomDigits = mt_rand(1000000000, 9999999999);
                  $encriptado = $randomDigits . $pivotId;

                  $data_update['ruta'] = $ruta;
                  $data_update['created_at'] = now();
                  $data_update['updated_at'] = now();
                  $data_update['codigo'] = $encriptado;

                  $update_pivot = $solicitud->certificados()->updateExistingPivot(
                     $certificado,
                     $data_update
                  );

                  if ($update_pivot) {
                     if (isset($ruta)) {
                        $ruta = $certificadoData['ruta']->storeAs('documentos/' . $solicitud->documento . '/enviados/', $solicitud_id . '-' . $certificado_nombre . '.' . $certificadoData['ruta']->getClientOriginalExtension());
                     }
                  }
                  $ruta_pdf_existente = 'storage/documentos/' . $solicitud->documento . '/enviados/' . $solicitud_id . '-' . $certificado_nombre . '.' . $certificadoData['ruta']->getClientOriginalExtension();
                  $ruta_qr = 'storage/documentos/' . $solicitud->documento . '/enviados/' . $solicitud_id . '-' . $certificado_nombre . 'qr.png';
                  // Crear una nueva instancia de FPDI
                  $pdf = new Fpdi();
                  // Establecer el archivo fuente
                  $pdf->setSourceFile($ruta_pdf_existente);


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
                  $y = $alto_pagina - $tamaño_qr - 28;

                  //Agrego el Qr al PDF y guardo el PDF
                  $pdf->Image($ruta_qr, $x, $y, $tamaño_qr, $tamaño_qr);
                  $x_text = $x; // Alinear con el QR
                  $y_text = $y + $tamaño_qr + 2; // Debajo del QR

                  $pdf->SetFont('Helvetica', '', 10); // Fuente y tamaño
                  $pdf->SetTextColor(0, 0, 0); // Color negro
                  $pdf->SetXY($x_text, $y_text);
                  $pdf->Cell($tamaño_qr, 5, $encriptado, 0, 0, 'C');

                  $pdf->Output($ruta_pdf_existente, 'F');

                  // Agregar el archivo al array de adjuntos
                  $adjuntos[] = $ruta_pdf_existente;

               }
            }
            Mail::to($solicitud->correo)->send(new CertificadoMail($solicitud_id, $solicitud->nombre_completo, $adjuntos, $request->asunto_correo));
            DB::commit();
         } catch (\Exception $e) {
            DB::rollBack();
            // Captura cualquier excepción y devuelve una respuesta de error
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
         }
      }
      return redirect()->route('solicitudes.admin.index')->with('success', 'Solicitud actualizada exitosamente.');
   }

   public function updateArchivos(Request $request)
   {
      $solicitud = Solicitud::find($request->id);

      if ($solicitud) {
         try {

            DB::beginTransaction();

            if ($request->hasFile('adj_documento')) {
               $adj_documento = 'documentos/' . $solicitud->documento . '/documento.' . $request->file('adj_documento')->getClientOriginalExtension();
               $solicitud->adj_documento = $adj_documento;
               $request->file('adj_documento')->storeAs('documentos/' . $solicitud->documento, 'documento.' . $request->file('adj_documento')->getClientOriginalExtension());
            }

            if ($request->hasFile('adj_estampilla')) {
               $adj_estampilla = 'documentos/' . $solicitud->documento . '/estampilla.' . $request->file('adj_estampilla')->getClientOriginalExtension();
               $solicitud->adj_estampilla = $adj_estampilla;
               $request->file('adj_estampilla')->storeAs('documentos/' . $solicitud->documento, 'estampilla.' . $request->file('adj_estampilla')->getClientOriginalExtension());
            }

            if ($request->hasFile('adj_pago')) {
               $adj_pago = 'documentos/' . $solicitud->documento . '/pago.' . $request->file('adj_pago')->getClientOriginalExtension();
               $solicitud->adj_pago = $adj_pago;
               $request->file('adj_pago')->storeAs('documentos/' . $solicitud->documento, 'pago.' . $request->file('adj_pago')->getClientOriginalExtension());
            }

            $solicitud->updated_at = now();
            $solicitud->edit_adj_documento = 0;
            $solicitud->edit_adj_estampilla = 0;
            $solicitud->edit_adj_pago = 0;
            $solicitud->save();

            DB::commit();
         } catch (\Exception $e) {
            DB::rollBack();
            // Captura cualquier excepción y devuelve una respuesta de error
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
         }
      }
      return redirect()->route('solicitudes.index')->with('success', 'Solicitud actualizada exitosamente.');
   }

   public function data()
   {
      $datos = Solicitud::with('certificados', 'userUts')->orderBy('updated_at', 'desc')->get();
      return response()->json($datos);
   }

   public function dataAll()
   {
      $datos = Solicitud::with('certificados')->orderBy('updated_at', 'desc')->get();
      return response()->json($datos);
   }
}
