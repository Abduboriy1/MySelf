<?php

use App\Http\Controllers\AiChatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/query-rag', [AiChatController::class, 'query'])
    ->middleware('throttle:10,1');
