<?php

use App\Http\Controllers\BibleApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/bibles', [BibleApiController::class, 'getBibles']);
Route::get('/bibles/{bibleId}/books', [BibleApiController::class, 'getBooks']);




