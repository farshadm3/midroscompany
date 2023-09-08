<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\PanelController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;


Route::namespace('')->group(function () {
    Route::get('/', [PanelController::class, 'index'])->name('panel');
    Route::resource('/products', ProductController::class);

    Route::get('/contact', [ContactController::class, 'index'])->name('contact');

    //categories
    Route::resource('/categories', CategoryController::class)->middleware('auth.admin');
    Route::get('/category/getSub/{category}', [CategoryController::class, 'getSub'])->name('category.get.sub');
    Route::patch('/categories/status/{category}', [CategoryController::class, "changeStatus"])->middleware('auth.admin')->name('categories.changeStatus');
    Route::get('/category/parent', [CategoryController::class, 'getParent'])->name('category.get.parent');
});
