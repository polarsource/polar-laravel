<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ConfirmationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductsController::class, 'handle']);
Route::get('/checkout', [CheckoutController::class, 'handle']);
Route::get('/confirmation', [ConfirmationController::class, 'handle']);
