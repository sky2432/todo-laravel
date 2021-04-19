<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TodoDoneController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\StatisticsController;

//ユーザー
Route::apiResource('/users', UserController::class);
Route::post('/userRegister/confirm', [UserController::class, 'confirm']);

//Todo
Route::apiResource('/todoLists', TodoController::class)->except('index');
Route::get('/todoLists/today/{id}', [TodoController::class, 'today']);
Route::get('/todoLists/user/{id}', [TodoController::class, 'userAllTodo']);
Route::apiResource('/todoLists/done', TodoDoneController::class)->only(['show', 'update', 'destroy']);

//ファイル
Route::apiResource('/files', FileController::class)->only(['show', 'update']);

//メール
Route::post('/sendMail/register', [SendMailController::class, 'register']);
Route::post('/sendMail/login', [SendMailController::class, 'login']);


//ログイン・ログアウト
Route::post('/login', [LoginController::class, 'login']);
Route::post('/login/confirm', [LoginController::class, 'confirm']);
Route::post('/logout', LogoutController::class);

//統計
//日
Route::post('/statistics/day', [StatisticsController::class, 'day']);
Route::post('/statistics/day/back', [StatisticsController::class, 'backDay']);
Route::post('/statistics/day/forward', [StatisticsController::class, 'forwardDay']);
//週
Route::post('/statistics/week', [StatisticsController::class, 'week']);
Route::post('/statistics/week/back', [StatisticsController::class, 'backWeek']);
Route::post('/statistics/week/forward', [StatisticsController::class, 'forwardWeek']);
//月
Route::post('/statistics/month', [StatisticsController::class, 'month']);
Route::post('/statistics/month/back', [StatisticsController::class, 'backMonth']);
Route::post('/statistics/month/forward', [StatisticsController::class, 'forwardMonth']);

Route::post('/statistics/count/all', [StatisticsController::class, 'countAll']);
Route::post('/statistics/count/day', [StatisticsController::class, 'countDay']);
Route::post('/statistics/count/month', [StatisticsController::class, 'countMonth']);

Route::post('/statistics/avarage/day', [StatisticsController::class, 'avarageDay']);




