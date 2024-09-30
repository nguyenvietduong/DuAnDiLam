<?php

use App\Http\Controllers\Frontend\PostDetailController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\SysadminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',                                 [HomeController::class, 'index'])->name('home');
Route::get('/post',                             [PostController::class, 'index'])->name('post');