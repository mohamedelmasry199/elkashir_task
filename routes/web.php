<?php

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

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;

// Grouped routes for categories
Route::group(['prefix' => 'categories'], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/{category}/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{category}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');
});
Route::group(['prefix' => 'subcategories'], function () {
    Route::get('/', [SubCategoryController::class, 'index'])->name('subcategories.index');
    Route::get('/create', [SubCategoryController::class, 'create'])->name('subcategories.create');
    Route::post('/store', [SubCategoryController::class, 'store'])->name('subcategories.store');
    Route::get('/{category}', [SubCategoryController::class, 'show'])->name('subcategories.show');
    Route::get('/{category}/edit', [SubCategoryController::class, 'edit'])->name('subcategories.edit');
    Route::put('/{category}/update', [SubCategoryController::class, 'update'])->name('subcategories.update');
    Route::delete('/{category}/destroy', [SubCategoryController::class, 'destroy'])->name('subcategories.destroy');
});



