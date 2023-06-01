<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth'); // Home

Route::get('/create-report', [UserController::class, 'generarPDF'])->name('crear-reporte')->middleware('auth'); // Generar PDF

Route::resource('/users', UserController::class)->middleware('auth'); // CRUD - Usuarios

Route::post('/users/{id}/cargar-saldo', [UserController::class, 'cargarSaldo'])->name('users.cargarSaldo')->middleware('auth'); // Cargar Saldo

Route::post('/users/cargar-saldo-modal', [UserController::class, 'cargarSaldoModal'])->name('users.cargarSaldoModal')->middleware('auth'); // Cargar Saldo Modal

Route::post('/users/quitar-saldo-modal', [UserController::class, 'quitarSaldoModal'])->name('users.quitarSaldoModal')->middleware('auth'); // Quitar Saldo Modal