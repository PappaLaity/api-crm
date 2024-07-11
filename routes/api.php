<?php

use App\Http\Controllers\StructureController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {

    Route::get('/index', function () {
        return "Hello World";
    });
    Route::apiResource('structures', StructureController::class);
});
