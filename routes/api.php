<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TodoDoneController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\ValidateRegisterController;
use App\Http\Controllers\ValidateLoginController;

//ユーザー
Route::apiResource('/users', UserController::class)->only(['store','update', 'destroy']);

//Todo
Route::apiResource('/todoLists', TodoController::class)->except('index');
Route::apiResource('/todoListsDone', TodoDoneController::class)->only(['show', 'update', 'destroy']);

//ファイル
Route::apiResource('/files', FileController::class)->only(['show', 'update']);

//メール
Route::post('/sendRegisterMail', [SendMailController::class, 'registerMail']);
Route::post('/sendLoginMail', [SendMailController::class, 'loginMail']);

//ログイン・ログアウト
Route::post('/login', LoginController::class);
Route::post('/logout', LogoutController::class);

//バリデーション
Route::post('/validateRegister', ValidateRegisterController::class);
Route::post('/validateLogin', ValidateLoginController::class);
