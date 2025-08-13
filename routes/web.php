<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LabelController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/labels/{eggBatch}/pdf', [LabelController::class, 'generatePdf'])
    ->name('labels.pdf');
