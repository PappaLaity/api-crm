<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderLineController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::get('/token', function () {
        return response()->json([
            "message" => "token not found"
        ], status: 404);
    })->name('login');
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])
        ->middleware('auth:sanctum');

    Route::apiResource('structures', StructureController::class);
    Route::get('providers', [StructureController::class, 'getProviders']);
    Route::apiResource('users', UserController::class);//->middleware('auth:sanctum');;
    Route::apiResource('products', ProductController::class);
    Route::get('products/company/{id}', [ProductController::class, 'getProductForCompany']);
    Route::get('products/provider/{id}', [ProductController::class, 'getProductForProvider']);
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('orders_lines', OrderLineController::class);
    Route::apiResource('stocks', StockController::class);
    Route::apiResource('customers', CustomerController::class);
});
