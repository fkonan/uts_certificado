<?php

use App\Http\Controllers\CertificadosController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {
   Route::get('/', function () {
      return view('dashboard');
   });

   Route::get('/dashboard', function () {
      return view('dashboard');
   })->name('dashboard');

   Route::get('/home', function () {
      return view('home');
   })->name('home');

   Route::get('solicitudes/admin/index/{estado?}', [SolicitudController::class, 'IndexAdmin'])->name('solicitudes.admin.index')->middleware('can:is_admin');
   //Route::get('/solicitudes/admin/data', [SolicitudController::class, 'data'])->name('solicitudes.admin.data')->middleware('can:is_admin');
   //Route::get('solicitudes/admin/data/all', [SolicitudController::class, 'dataAll'])->name('solicitudes.admin.data.all')->middleware('can:is_admin');

   Route::resource('solicitudes', SolicitudController::class, ['except' => ['show']]);
   Route::get('/solicitudes/{id}/ver', [SolicitudController::class, 'ver'])->name('solicitudes.ver');
   Route::post('/solicitudes/actualizar-archivos', [SolicitudController::class, 'updateArchivos'])->name('solicitudes.updateArchivos');

   Route::resource('certificados', CertificadosController::class, ['except' => ['show']]);
   Route::get('/certificados/data/', [CertificadosController::class, 'data'])->name('certificados.data');

   Route::middleware(['can:is_admin'])->get('/solicitudes/admin/data', [SolicitudController::class, 'data'])->name('solicitudes.admin.data');

   Route::get('users/{id}/profile', [UserController::class, 'show'])->name('user.profile.show');
   Route::put('users/profile/update', [UserController::class, 'update'])->name('user.profile.update');
});

Route::get('/sanctum/csrf-cookie', function () {
   return response()->json(['csrf' => csrf_token()]);
});

Route::get('solicitudes/listar/{id}', [SolicitudController::class, 'show'])->name('solicitudes.show');
Route::get('solicitudes/encrypted/{encryptedId}', [SolicitudController::class, 'showEncrypted'])->name('solicitudes.showEncrypted');
