<?php

namespace App\Http\Controllers;

use App\Models\Certificados;
use Illuminate\Http\Request;

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
            'mensaje' => 'max:255'
        ]);

        $data['user_id'] = auth()->user()->id;
        $data['estado'] = 1;

        Certificados::create($data);

        return redirect()->route('certificados.index')->with('success', 'Certificado registrado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Certificados $certificados)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Certificados $certificados)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Certificados $certificados)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificados $certificados)
    {
        //
    }

    public function data()
    {
        $certificados = Certificados::with('user')->get();
        return $certificados;
    }
}
