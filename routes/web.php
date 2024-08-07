<?php

use App\Http\Controllers\CertificadosController;
use App\Http\Controllers\SolicitudController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {
   Route::get('/', function () {
      return view('welcome');
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
   Route::resource('certificados', CertificadosController::class, ['except' => ['show']]);
   Route::get('/certificados/data/', [CertificadosController::class, 'data'])->name('certificados.data');
});

Route::get('solicitudes/listar/{id}', [SolicitudController::class, 'show'])->name('solicitudes.show');
Route::get('solicitudes/encrypted/{encryptedId}', [SolicitudController::class, 'showEncrypted'])->name('solicitudes.showEncrypted');
