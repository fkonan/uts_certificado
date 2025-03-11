<?php

namespace App\Http\Controllers;

use App\Models\ConfigMensajeInicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfigMensajeInicioController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
      return view('config_mensaje_inicio.index');
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
      return view('config_mensaje_inicio.create');
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(int $id)
   {
      $datos = ConfigMensajeInicio::find($id);
      return view('config_mensaje_inicio.edit', compact('datos'));
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, ConfigMensajeInicio $datos)
   {
      $request->validate([
         'banner' => 'required|image|max:2048',
         'titulo_video' => 'required|max:30',
         'url_video' => 'required|url|max:200',
         'texto1' => 'required|max:1000',
         'texto2' => 'nullable|max:200'
      ]);

      if ($request->hasFile('banner')) {
         $ruta_banner = 'images/banner_inicio.'  . $request->file('banner')->getClientOriginalExtension();
         $request->file('banner')->storeAs('images/banner_inicio.'. $request->file('banner')->getClientOriginalExtension());
         $datos->banner = $ruta_banner;
      }

      $datos->titulo_video = $request->input('titulo_video');
      $datos->url_video = $request->input('url_video');
      $datos->texto1 = $request->input('texto1');
      $datos->texto2 = $request->input('texto2');
      $datos->user_id = Auth::id();

      $datos->save();

      return redirect()->route('config_mensaje_inicio.index')
         ->with('success', 'Registro actualizado exitosamente.');
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(int $id)
   {
      $datos = ConfigMensajeInicio::find($id);
      $datos->delete();
      return redirect()->route('config_mensaje_inicio.index')
         ->with('success', 'Registro eliminado exitosamente.');
   }

   public function data()
   {
      $datos = ConfigMensajeInicio::with('user')->get();
      return response()->json($datos);
   }
}
