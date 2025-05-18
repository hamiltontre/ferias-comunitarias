<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeriaController;
use App\Http\Controllers\EmprendedorController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas para Ferias
Route::resource('ferias', FeriaController::class);
Route::post('ferias/{feria}/emprendedores', [FeriaController::class, 'attachEmprendedor'])->name('ferias.attachEmprendedor');
Route::delete('ferias/{feria}/emprendedores/{emprendedor}', [FeriaController::class, 'detachEmprendedor'])->name('ferias.detachEmprendedor');

// Rutas para Emprendedores
Route::resource('emprendedores', EmprendedorController::class)->parameters([
    'emprendedores' => 'emprendedor' 
]);
Route::post('emprendedores/{emprendedor}/ferias', [EmprendedorController::class, 'attachFeria'])
     ->name('emprendedores.attachFeria');
Route::delete('emprendedores/{emprendedor}/ferias/{feria}', [EmprendedorController::class, 'detachFeria'])
     ->name('emprendedores.detachFeria');