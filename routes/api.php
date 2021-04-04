<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\DoneTodoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\FormValidateController;
use App\Http\Controllers\LoginValidateController;

//ユーザー
Route::apiResource('/users', UserController::class)->only(['store','update', 'destroy']);

//Todo
Route::apiResource('/todoLists', TodoController::class)->except('index');
Route::apiResource('/doneTodoLists', DoneTodoController::class)->only(['show', 'update', 'destroy']);

//ファイル
Route::apiResource('/files', FileController::class)->only(['show', 'update']);

//メール
Route::post('/sendRegisterMail', [SendMailController::class, 'registerMail']);
Route::post('/sendLoginMail', [SendMailController::class, 'loginMail']);

//ログイン・ログアウト
Route::post('/login', LoginController::class);
Route::post('/logout', LogoutController::class);

//バリデーション
Route::post('/formValidate', FormValidateController::class);
Route::post('/loginValidate', LoginValidateController::class);


