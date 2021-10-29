<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Fechas;
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

Route::redirect('/', 'hola'); // Redireccionamos la ruta / a /hola

// Get Methods
Route::get('/hola', function () {
    return view('index');
})->name('inicio');

Route::get('/fecha', [Fechas::class, 'obtenerFechaSistema'])->name('fecha');

Route::match(['get', 'post'], '/edad', [Fechas::class, 'calcularEdad'])->name('edad');

Route::match(['get', 'post'], '/cumpleanos', [Fechas::class, 'calcularCumpleanos'])->name('cumpleanos');
