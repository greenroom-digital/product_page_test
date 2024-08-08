<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;


Route::post('login', [AuthController::class, 'login']);

Route::get('client/products/{slug}', [ProductController::class, 'showBySlug']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('products/{slug}', [ProductController::class, 'showBySlug']);

    Route::post('logout', [AuthController::class, 'logout']);
});