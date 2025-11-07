<?php

use App\Http\Controllers\Api\NoticiaController;
use Illuminate\Support\Facades\Route;

Route::get('/noticias', [NoticiaController::class, 'index']);
Route::get('/noticias/{id}', [NoticiaController::class, 'show']);

