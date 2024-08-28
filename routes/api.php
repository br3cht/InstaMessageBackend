<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('message/send',[ChatController::class,'sendMessage']);

Route::get('messages',[ChatController::class,'getMessages']);

Route::resources([
    'user' => UserController::class,
]);
