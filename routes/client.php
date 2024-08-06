<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Client Routes
|--------------------------------------------------------------------------
|
| Route related to the client application test
|
*/

Route::get('temp-auth', [AuthController::class, 'login'])->name('auth.fake');

Route::middleware('auth:sanctum')->group(function() {
  Route::get('products/{slug}', [ProductController::class, 'show'])->name('product.show');
});
