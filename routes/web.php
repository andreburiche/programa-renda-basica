<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CidadaoController;

Route::get('/', [CidadaoController::class, 'index'])->name('home');
Route::post('/consultar', [CidadaoController::class, 'consultar'])->name('consultar');
