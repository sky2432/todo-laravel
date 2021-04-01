<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\DoneTodoController;
use App\Http\Controllers\FormValidateController;
use App\Http\Controllers\LoginValidateController;
use App\Http\Controllers\DeleteUserController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UpdateUserController;
use App\Http\Controllers\SendLoginMailController;
use App\Http\Controllers\SendRegisterMailController;

//Todo
Route::apiResource('/todo', TodoController::class)->except('index');
Route::apiResource('/doneTodo', DoneTodoController::class)->only([
  'show', 'update', 'destroy'
]);

Route::post('/register', [RegisterController::class, 'post']);

//ログイン・ログアウト
Route::post('/login', [LoginController::class, 'post']);
Route::post('/logout', [LogoutController::class, 'post']);

//ファイル
Route::apiResource('/file', FileController::class)->only([
 'show', 'update'
]);

//バリデーション
Route::post('/formValidate', [FormValidateController::class, 'post']);
Route::post('/loginValidate', [LoginValidateController::class, 'post']);

//ユーザー
Route::apiResource('/deleteUser', DeleteUserController::class)->only('destroy');
Route::apiResource('/updateUser', UpdateUserController::class)->only('update');

//メール
Route::apiResource('/sendLoginMail', SendLoginMailController::class)->only('show');
Route::post('/sendRegisterMail', [SendRegisterMailController::class, 'post']);
