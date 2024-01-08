<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ActionController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/open', [ActionController::class, 'open']);
Route::get('/click', [ActionController::class, 'click']);
Route::post('/send', [ActionController::class, 'send']);

Route::post('/email/set', [EmailController::class, 'set']);
Route::get('/email/get', [EmailController::class, 'get']);
Route::get('/email/next', [EmailController::class, 'next']);
