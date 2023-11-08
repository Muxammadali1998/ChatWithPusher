<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/chat',[ChatController::class, 'index']);
Route::get('/chatid',[ChatController::class, 'chat']);
Route::post('/message',[MessageController::class, 'store']);
// Route::post('/chat',[ChatController::class, 'store']);
Route::get('/chats/{id}',[MessageController::class, 'index']);
Route::get('/alert/{id}',[ChatController::class, 'alert']);

Route::post('/user',[\App\Http\Controllers\UserController::class, 'store']);
Route::put('/user',[\App\Http\Controllers\UserController::class, 'update']);
Route::post('/user/{id}',[\App\Http\Controllers\UserController::class, 'destroy']);

