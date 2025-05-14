<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeriaController;
use App\Http\Controllers\EmprendedorController;


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

Route::resource('ferias', FeriaController::class);
Route::resource('emprendedores', EmprendedorController::class);
Route::post('/ferias/{feria}/emprendedores', [FeriaController::class, 'attachEmprendedor']);