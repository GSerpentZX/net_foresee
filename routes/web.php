<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassificationController;


// Route::get('/', function () {
//     return view('welcome');
// });

// Route untuk menampilkan form
Route::get('/', [ClassificationController::class, 'showForm'])->name('show.form');

// Route untuk memproses form
Route::post('/submit-form', [ClassificationController::class, 'classify'])->name('submit.form');

//asasdasdad