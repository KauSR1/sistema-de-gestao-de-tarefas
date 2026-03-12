<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthController::class, 'userlogin'])->name('login');
Route::post('/userLoginSubmit', [AuthController::class, 'userLoginSubmit'])->name('loginSubmit');

Route::get('/register', [AuthController::class, 'userRegister'])->name('register');
Route::post('/userRegisterSubmit', [AuthController::class, 'userRegisterSubmit'])->name('registerSubmit');

Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');