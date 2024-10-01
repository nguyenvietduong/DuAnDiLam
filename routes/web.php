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

Route::get('/tag/{id}',                         [TagController::class, 'index'])->where(['id' => '[0-9]+'])->name('tag');
Route::get('/category/{id}',                    [CategoryController::class, 'index'])->where(['id' => '[0-9]+'])->name('category');
Route::get('/post-detail/{id}',                 [PostDetailController::class, 'index'])->where(['id' => '[0-9]+'])->name('post.detail');
Route::post('/post-detail/add_comment/{id}',    [PostDetailController::class, 'store'])->where(['id' => '[0-9]+'])->name('post.detail.add.comment');
Route::get('/search',                           [SearchController::class, 'index'])->where(['search' => '[a-zA-Z0-9]+'])->name('search');

Route::middleware(['auth'])->group(function () {
    Route::get('/post/create',                  [PostController::class, 'create'])->name('post.create');
    Route::post('/post',                        [PostController::class, 'store'])->name('post.store');
});

Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/manager',  [ManagerController::class, 'index'])->name('manager.dashboard');
    Route::get('/user',     [UserController::class, 'index'])->name('user.dashboard');
    // Các route khác của manager
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user',     [UserController::class, 'index'])->name('user.dashboard');
    // Các route khác của user
});
