<?php

use App\Http\Controllers\SolicitudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
   return $request->user();
});

Route::middleware(['auth:sanctum', 'can:is_admin'])->get('/v1/solicitudes/admin/data', [SolicitudController::class, 'data'])->name('solicitudes.admin.data');
