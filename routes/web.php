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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('solicitudes/admin', [SolicitudController::class, 'IndexAdmin'])->name('solicitudes.admin');
    Route::get('solicitudes/admin/data', [SolicitudController::class, 'data'])->name('solicitudes.admin.data');

    Route::resource('solicitudes', SolicitudController::class);


    Route::resource('certificados', CertificadosController::class,['except' => ['show']]);

    Route::get('/certificados/data/', [CertificadosController::class, 'data'])->name('certificados.data');
});
