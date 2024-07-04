<?php

namespace App\Http\Controllers;

use App\Models\Certificados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultaController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
      return view('certificados.consulta');
   }

   public function data()
   {
      $certificados = Certificados::with('user')->get();
      return response()->json($certificados);
      // return $certificados;
   }
}
