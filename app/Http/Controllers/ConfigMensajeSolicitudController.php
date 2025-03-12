<?php

namespace App\Http\Controllers;

use App\Models\ConfigMensajeInicio;
use App\Models\ConfigMensajeSolicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfigMensajeSolicitudController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
      return view('config_mensaje_solicitud.index');
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
      return view('config_mensaje_solicitud.create');
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(int $id)
   {
      $datos = ConfigMensajeSolicitud::find($id);
      return view('config_mensaje_solicitud.edit', compact('datos'));
   }

   public function store(Request $request)
   {
      $request->validate([
         'estado' => 'required|max:20',
         'asunto' => 'required|max:100',
         'descripcion' => 'required|max:200'
      ]);

      $datos = new ConfigMensajeSolicitud();

      $datos->estado = $request->estado;
      $datos->asunto = $request->asunto;
      $datos->descripcion = $request->descripcion;
      $datos->user_id = Auth::id();
      $datos->save();

      return redirect()->route('config-mensaje-solicitud.index')
         ->with('success', 'Registro creado exitosamente.');
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request)
   {
      $request->validate([
         'estado' => 'required|max:20',
         'asunto' => 'required|max:100',
         'descripcion' => 'required|max:200'
      ]);
      $datos = ConfigMensajeSolicitud::findOrFail($request->id);

      $datos->estado = $request->estado;
      $datos->asunto = $request->asunto;
      $datos->descripcion = $request->descripcion;
      $datos->user_id = Auth::id();
      $datos->updated_at = now();
      $datos->save();
      return redirect()->route('config-mensaje-solicitud.index')
         ->with('success', 'Registro actualizado exitosamente.');
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(int $id)
   {
      $datos = ConfigMensajeSolicitud::find($id);
      $datos->delete();
      return redirect()->route('config-mensaje-solicitud.index')
         ->with('success', 'Registro eliminado exitosamente.');
   }

   public function data()
   {
      $datos = ConfigMensajeSolicitud::with('user')->get();
      return response()->json($datos);
   }
}
