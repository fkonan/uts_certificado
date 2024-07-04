<?php

namespace App\Http\Controllers;

use App\Models\Certificados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificadosController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
      return view('certificados.index');
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
      return view('certificados.create');
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(Request $request)
   {
      $data = $request->validate([
         'tipo_certificado' => 'required|max:100|unique:certificados,tipo_certificado,except,id',
         'valor' => 'required|numeric',
         'mensaje' => 'nullable|max:255'
      ]);

      $data['user_id'] = auth()->user()->id;
      $data['estado'] = 1;

      Certificados::create($data);

      return redirect()->route('certificados.index')->with('success', 'Certificado registrado exitosamente.');
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(int $id)
   {
      $certificado = Certificados::find($id);
      return view('certificados.edit', compact('certificado'));
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, Certificados $certificado)
   {
      $request->validate([
         'tipo_certificado' => 'required|max:100|unique:certificados,tipo_certificado,' . $certificado->id,
         'valor' => 'required|numeric',
         'estado' => 'required'
      ]);

      $certificado->user_id = Auth::id();
      $certificado->update($request->all());

      return redirect()->route('certificados.index')
         ->with('success', 'Registro actualizado exitosamente.');
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(int $id)
   {
      $certificado = Certificados::find($id);
      $certificado->delete();
      return redirect()->route('certificados.index')
         ->with('success', 'Registro eliminado exitosamente.');
   }

   public function data()
   {
      $certificados = Certificados::with('user')->get();
      return response()->json($certificados);
      // return $certificados;
   }
}
