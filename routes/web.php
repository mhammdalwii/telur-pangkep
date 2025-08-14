<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LabelController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/panen/{panen}/label', [LabelController::class, 'generatePanenLabel'])
    ->name('panen.label.pdf');
