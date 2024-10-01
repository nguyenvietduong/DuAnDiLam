<?php

use App\Http\Controllers\Backend\Account\AdminController;
use App\Http\Controllers\Backend\Account\ProfileController;
use App\Http\Controllers\Backend\Account\UserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\CommentController;
use App\Http\Controllers\Backend\WordController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductTagController;
use App\Http\Controllers\Backend\ProductOptionController;
use App\Http\Controllers\Backend\RelatedProductController;
use App\Http\Controllers\Backend\ColorController;
use App\Http\Controllers\Backend\SizeController;
use App\Http\Controllers\ImageUploadController;
use Illuminate\Support\Facades\Route;

// Ajax Routes
Route::post('/upload-image', [ImageUploadController::class, 'upload'])->name('upload.image');
Route::post('/admin/post/updateStatus', [PostController::class, 'updateStatus'])->name('admin.post.updateStatus');
Route::post('/admin/comment/update-status/{comment}', [CommentController::class, 'updateStatus'])->name('admin.comment.updateStatus');

Route::middleware(['auth', 'role:sysadmin'])->group(function () {
    Route::prefix('admin')->group(function () {
        // Dashboard
        Route::get('/index', function () {
            return view('backend.dashboard.index');
        })->name('admin.dashboard.index');

        // User Management
        Route::prefix('user')->group(function () {
            Route::get('index',         [UserController::class, 'index'])->name('admin.user.index');
            Route::get('create',        [UserController::class, 'create'])->name('admin.user.create');
            Route::post('store',        [UserController::class, 'store'])->name('admin.user.store');
            Route::get('{id}/edit',     [UserController::class, 'edit'])->where('id', '[0-9]+')->name('admin.user.edit');
            Route::put('{id}/update',   [UserController::class, 'update'])->where('id', '[0-9]+')->name('admin.user.update');
            Route::delete('{id}/destroy', [UserController::class, 'destroy'])->where('id', '[0-9]+')->name('admin.user.destroy');
        });

        // Admin Management
        Route::prefix('admin')->group(function () {
            Route::get('index',         [AdminController::class, 'index'])->name('admin.admin.index');
            Route::get('create',        [AdminController::class, 'create'])->name('admin.admin.create');
            Route::post('store',        [AdminController::class, 'store'])->name('admin.admin.store');
            Route::get('{id}/edit',     [AdminController::class, 'edit'])->where('id', '[0-9]+')->name('admin.admin.edit');
            Route::put('{id}/update',   [AdminController::class, 'update'])->where('id', '[0-9]+')->name('admin.admin.update');
            Route::delete('{id}/destroy', [AdminController::class, 'destroy'])->where('id', '[0-9]+')->name('admin.admin.destroy');
        });

        // Profile Management
        Route::get('profile', function () {
            return view('backend.account.profile');
        })->name('admin.profile');
        Route::post('profile/update/image',     [ProfileController::class, 'updateProfileImage'])->name('profile.update.image');
        Route::post('profile/update',           [ProfileController::class, 'updateProfile'])->name('profile.update');

        // Category Management
        Route::prefix('category')->group(function () {
            Route::get('index',         [CategoryController::class, 'index'])->name('admin.category.index');
            Route::get('create',        [CategoryController::class, 'create'])->name('admin.category.create');
            Route::post('store',        [CategoryController::class, 'store'])->name('admin.category.store');
            Route::get('{id}/edit',     [CategoryController::class, 'edit'])->where('id', '[0-9]+')->name('admin.category.edit');
            Route::put('{id}/update',   [CategoryController::class, 'update'])->where('id', '[0-9]+')->name('admin.category.update');
            Route::delete('{id}/destroy', [CategoryController::class, 'destroy'])->where('id', '[0-9]+')->name('admin.category.destroy');
        });

        // Tag Management
        Route::prefix('tag')->group(function () {
            Route::get('index',         [TagController::class, 'index'])->name('admin.tag.index');
            Route::get('create',        [TagController::class, 'create'])->name('admin.tag.create');
            Route::post('store',        [TagController::class, 'store'])->name('admin.tag.store');
            Route::get('{id}/edit',     [TagController::class, 'edit'])->where('id', '[0-9]+')->name('admin.tag.edit');
            Route::put('{id}/update',   [TagController::class, 'update'])->where('id', '[0-9]+')->name('admin.tag.update');
            Route::delete('{id}/destroy', [TagController::class, 'destroy'])->where('id', '[0-9]+')->name('admin.tag.destroy');
        });

        // Post Management
        Route::prefix('post')->group(function () {
            Route::get('index',         [PostController::class, 'index'])->name('admin.post.index');
            Route::get('create',        [PostController::class, 'create'])->name('admin.post.create');
            Route::post('store',        [PostController::class, 'store'])->name('admin.post.store');
            Route::get('{id}/edit',     [PostController::class, 'edit'])->where('id', '[0-9]+')->name('admin.post.edit');
            Route::put('{id}/update',   [PostController::class, 'update'])->where('id', '[0-9]+')->name('admin.post.update');
            Route::delete('{id}/destroy', [PostController::class, 'destroy'])->where('id', '[0-9]+')->name('admin.post.destroy');
        });

        // Word Management
        Route::prefix('word')->group(function () {
            Route::get('index',         [WordController::class, 'index'])->name('admin.word.index');
            Route::get('create',        [WordController::class, 'create'])->name('admin.word.create');
            Route::post('store',        [WordController::class, 'store'])->name('admin.word.store');
            Route::get('{id}/edit',     [WordController::class, 'edit'])->where('id', '[0-9]+')->name('admin.word.edit');
            Route::put('{id}/update',   [WordController::class, 'update'])->where('id', '[0-9]+')->name('admin.word.update');
            Route::delete('{id}/destroy', [WordController::class, 'destroy'])->where('id', '[0-9]+')->name('admin.word.destroy');
        });

        // Comment Management
        Route::prefix('comment')->group(function () {
            Route::get('index',         [CommentController::class, 'index'])->name('admin.comment.index');
            Route::get('{id}/edit',     [CommentController::class, 'edit'])->where('id', '[0-9]+')->name('admin.comment.edit');
            Route::put('{id}/update',   [CommentController::class, 'update'])->where('id', '[0-9]+')->name('admin.comment.update');
            Route::get('{id}/delete',   [CommentController::class, 'delete'])->where('id', '[0-9]+')->name('admin.comment.delete');
            Route::delete('{id}/destroy', [CommentController::class, 'destroy'])->where('id', '[0-9]+')->name('admin.comment.destroy');
        });
    });
});
