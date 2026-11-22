<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return redirect()->route('categories.index');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('items.index');
    });
    Route::get('/home', function () {
        return redirect()->route('items.index');
    })->name('home');

    Route::resource('items', \App\Http\Controllers\ItemController::class);

    Route::resource('categories', CategoryController::class)->except(['show']);

    Route::resource('suppliers', \App\Http\Controllers\SupplierController::class)->except(['show']);
});
