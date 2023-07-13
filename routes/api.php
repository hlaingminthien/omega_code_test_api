<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::post('login', [AuthController::class, 'login']);
Route::get('/users', [UserController::class, 'index'])->middleware('auth.basic');
Route::post('users', [UserController::class, 'store'])->middleware('auth.basic');
Route::get('users/{id}', [UserController::class, 'show'])->middleware('auth.basic');
Route::patch('users/{id}', [UserController::class, 'update'])->middleware('auth.basic');
Route::delete('users/{id}', [UserController::class, 'destroy'])->middleware('auth.basic');
Route::get('/users/export/data', [UserController::Class, 'exportUsers'])->middleware('auth.basic');
Route::post('/users/send/email', [UserController::Class, 'sendEmail'])->middleware('auth.basic');




