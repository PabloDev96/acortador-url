<?php

use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/shorten', [UrlController::class, 'store']);
Route::get('/{code}', [UrlController::class, 'redirect']);
Route::get('/', fn() => view('acortador'));

