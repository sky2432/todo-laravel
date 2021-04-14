<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TodoDoneController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\SendMailController;

//ユーザー
Route::apiResource('/users', UserController::class);
Route::post('/userRegisterConfirm', [UserController::class, 'confirm']);

//Todo
Route::apiResource('/todoLists', TodoController::class)->except('index');
Route::get('/todoToday/{id}', [TodoController::class, 'showToday']);
Route::get('/userTodo/{id}', [TodoController::class, 'showUserTodo']);
Route::apiResource('/todoListsDone', TodoDoneController::class)->only(['show', 'update', 'destroy']);

//ファイル
Route::apiResource('/files', FileController::class)->only(['show', 'update']);

//メール
Route::post('/sendRegisterMail', [SendMailController::class, 'registerMail']);
Route::post('/sendLoginMail', [SendMailController::class, 'loginMail']);


//ログイン・ログアウト
Route::post('/login', [LoginController::class, 'login']);
Route::post('/loginConfirm', [LoginController::class, 'confirm']);
Route::post('/logout', LogoutController::class);

