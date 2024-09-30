<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/login',        [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login',       [AuthController::class, 'login']);

Route::get('/register',     [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register',    [AuthController::class, 'register']);

Route::post('/logout',      [AuthController::class, 'logout'])->name('logout');


Route::get('forgot-password',           [ForgotPasswordController::class, 'showLinkRequestForm'])   ->name('password.request');
Route::post('forgot-password',          [ForgotPasswordController::class, 'sendResetLinkEmail'])    ->name('password.email');
Route::get('reset-password/{token}',    [ResetPasswordController::class, 'showResetForm'])          ->name('password.reset');
Route::post('reset-password',           [ResetPasswordController::class, 'reset'])                  ->name('password.update');
