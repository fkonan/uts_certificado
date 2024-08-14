<?php

use App\Http\Controllers\PrestamoPlanosController;
use App\Http\Controllers\SolicitudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/prestamo-planos/getAll', [PrestamoPlanosController::class, 'getAll'])->name('prestamo_planos.getAll');
Route::get('/prestamo-planos/radicado/{$radicado}', [PrestamoPlanosController::class, 'getByRadicado'])->name('prestamo_planos.getByRadicado');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});

Route::middleware(['auth:sanctum', 'can:is_admin'])->get('/v1/solicitudes/admin/data', [SolicitudController::class, 'data'])->name('solicitudes.admin.data');
