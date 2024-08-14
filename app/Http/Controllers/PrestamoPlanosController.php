<?php

namespace App\Http\Controllers;

use App\Models\PrestamoPlanos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrestamoPlanosController extends Controller
{
   function getAll()
   {
      $datos = PrestamoPlanos::get();
      return response()->json($datos);
   }

   function getByRadicado($radicado)
   {
      $datos = PrestamoPlanos::where('radicado', $radicado)->get();
      return response()->json($datos);
   }

   function store(Request $request)
   {

      // `id`,
      // `radicado`,
      // `fecha_solicitud`,
      // `nombre_solicitante`,
      // `documento_identificacion`,
      // `direccion_solicitante`,
      // `correo_electronico`,
      // `telefono`,
      // `numero_licencia`,
      // `modalidad_licencia`,
      // `direccion_predio`,
      // `barrio`,
      // `numero_folio_matricula_inmobiliaria`,
      // `propietario_predio`,
      // `nombre_constructor`,
      // `fecha_aproximada_documentacion`,
      // `documentos_requeridos`,
      // `motivo_destinacion`,
      // `observaciones`,
      // `estado_solicitud`,
      // `documento_certificado_libertad`,
      // `documento_no_encontrado`,
      // `acepta_terminos`,
      // `autoriza_notificacion`,
      // `fecha_aprobacion`,
      // `created_at`,
      // `updated_at`,

      $data = $request->validate([
         'radicado' => 'required|max:100|unique:prestamo_planos,radicado,except,id',
         'fecha_prestamo' => 'required|date',
         'fecha_devolucion' => 'required|date',
         'estado' => 'required|numeric',
         'user_id' => 'required|numeric'
      ]);

      $data['user_id'] = auth()->user()->id;

      PrestamoPlanos::create($data);

      return response()->json(['message' => 'Prestamo registrado exitosamente.']);
   }
}
