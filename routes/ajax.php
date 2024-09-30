<?php

use App\Http\Controllers\Ajax\Backend\Role\CreateRoleAjax;
use App\Http\Controllers\Ajax\Backend\Role\GetRoleDataAjax;
use App\Http\Controllers\Ajax\Backend\Role\UpdateRoleAjax;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ajax\LanguageController;
use App\Http\Controllers\Ajax\ThemeController;

// Set System Ajax
Route::post('/set-language',        [LanguageController::class, 'setLanguage']);
Route::post('/set-theme',           [ThemeController::class,    'setTheme'])->name('set.theme');