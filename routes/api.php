<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\DoneTodoController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\FormValidateController;
use App\Http\Controllers\LoginValidateController;
use App\Http\Controllers\DeleteAccountController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\UpdateUserController;
use App\Http\Controllers\SendLoginMailController;
use App\Http\Controllers\SendRegisterMailController;

Route::apiResource('/todo', TodoController::class)->except('index');
Route::apiResource('/doneTodo', DoneTodoController::class)->only([
  'show', 'update', 'destroy'
]);
Route::post('/register', [RegisterController::class, 'post']);
Route::post('/login', [LoginController::class, 'post']);
Route::post('/logout', [LogoutController::class, 'post']);
Route::post('/formValidate', [FormValidateController::class, 'post']);
Route::post('/loginValidate', [LoginValidateController::class, 'post']);
Route::apiResource('/deleteAccount', DeleteAccountController::class)->only('destroy');
Route::apiResource('/fileUpload', FileUploadController::class)->only([
  'show', 'update'
]);
Route::apiResource('/updateUser', UpdateUserController::class)->only('update');
Route::apiResource('/sendLoginMail', SendLoginMailController::class)->only('show');
Route::post('/sendRegisterMail', [SendRegisterMailController::class, 'post']);

// Route::get('/member', [MembersController::class, 'get']);
// Route::put('/member', [MembersController::class, 'puït']);
