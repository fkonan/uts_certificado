<?php

use App\Http\Controllers\CertificadosController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\SolicitudManualController;
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

   Route::middleware(['can:is_admin'])->group(function () {
      Route::get('usuarios', [UserController::class, 'index'])->name('user.index');
      Route::get('usuarios/nuevo', [UserController::class, 'create'])->name('user.create');
      Route::get('usuarios/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
      Route::post('usuarios', [UserController::class, 'store'])->name('user.store');
      Route::put('usuarios/{id}', [UserController::class, 'updateUser'])->name('user.update');
      Route::put('usuarios/{id}/estado', [UserController::class, 'updateStatusUser'])->name('user.status');

      Route::get('solicitud/manual', [SolicitudManualController::class, 'create'])->name('solicitud.manual.create');
      Route::post('solicitud/manual', [SolicitudManualController::class, 'store'])->name('solicitud.manual.store');

   });
});

Route::get('/sanctum/csrf-cookie', function () {
   return response()->json(['csrf' => csrf_token()]);
});

Route::get('solicitudes/listar/{id}', [SolicitudController::class, 'show'])->name('solicitudes.show');
Route::get('solicitudes/encrypted/{encryptedId}', [SolicitudController::class, 'showEncrypted'])->name('solicitudes.showEncrypted');


Route::get('/clear', function () {
   Artisan::call('storage:link');
   Artisan::call('cache:clear');
   Artisan::call('config:cache');
   Artisan::call('view:clear');
   return "Cleared!";
});

Route::get('/permisos', function () {
   try {
      // Cambiar permisos de storage y bootstrap/cache
      exec('chmod -R 775 storage bootstrap/cache');
      exec('chown -R www-data:www-data storage bootstrap/cache');

      return "Permisos ajustados correctamente.";
   } catch (\Exception $e) {
      return "Error: " . $e->getMessage();
   }
});
