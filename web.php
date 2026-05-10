<?php

use App\Http\Controllers\TrashController;
use Illuminate\Support\Facades\Route;

// Route utama untuk memanggil Controller
Route::get('/', [TrashController::class, 'index'])->name('dashboard');