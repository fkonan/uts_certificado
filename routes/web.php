<?php

use App\Http\Controllers\CertificadosController;
use App\Http\Controllers\ConfigMensajeInicioController;
use App\Http\Controllers\ConfigMensajeSolicitudController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\SolicitudManualController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {
   Route::get('/', function () {
      return redirect()->route('home.index');
   });

   Route::get('/dashboard', function () {
      return view('dashboard');
   })->name('dashboard');

   Route::get('/home', [HomeController::class, 'index'])->name('home.index');

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

      Route::get('config-mensaje-inicial', [ConfigMensajeInicioController::class, 'index'])->name('config-mensaje-inicial.index');
      Route::get('config-mensaje-inicial/{id}/edit', [ConfigMensajeInicioController::class, 'edit'])->name('config-mensaje-inicial.edit');
      Route::put('config-mensaje-inicial/update', [ConfigMensajeInicioController::class, 'update'])->name('config-mensaje-inicial.update');
      Route::get('config-mensaje-inicial/data', [ConfigMensajeInicioController::class, 'data'])->name('config-mensaje-inicial.data');

      Route::get('config-mensaje-solicitud', [ConfigMensajeSolicitudController::class, 'index'])->name('config-mensaje-solicitud.index');
      Route::get('config-mensaje-solicitud/nuevo', [ConfigMensajeSolicitudController::class, 'create'])->name('config-mensaje-solicitud.create');
      Route::get('config-mensaje-solicitud/{id}/edit', [ConfigMensajeSolicitudController::class, 'edit'])->name('config-mensaje-solicitud.edit');
      Route::post('config-mensaje-solicitud/store', [ConfigMensajeSolicitudController::class, 'store'])->name('config-mensaje-solicitud.store');
      Route::put('config-mensaje-solicitud/update', [ConfigMensajeSolicitudController::class, 'update'])->name('config-mensaje-solicitud.update');
      Route::get('config-mensaje-solicitud/data', [ConfigMensajeSolicitudController::class, 'data'])->name('config-mensaje-solicitud.data');
      Route::delete('config-mensaje-solicitud/{id}', [ConfigMensajeSolicitudController::class, 'destroy'])->name('config-mensaje-solicitud.destroy');
   });
});

Route::get('/sanctum/csrf-cookie', function () {
   return response()->json(['csrf' => csrf_token()]);
});

Route::get('solicitudes/listar/{id}', [SolicitudController::class, 'show'])->name('solicitudes.show');
Route::get('consulta/index', [ConsultaController::class, 'index'])->name('consulta.index');
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
