<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SentimentController;

Route::get('/', [SentimentController::class, 'index']);
Route::post('/analyze', [SentimentController::class, 'analyze']);

