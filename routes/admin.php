<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class, 'index'])->name('admin.index');

Route::resource('categories', CategoryController::class)->names('admin.categories');

Route::resource('tags', TagController::class)->names('admin.tags');