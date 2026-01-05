<?php

use App\Http\Controllers\Api\V1\TourSearchController;
use App\Http\Controllers\Api\V1\TourController;
use App\Http\Controllers\Api\V1\TravelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::apiResource('travels', TravelController::class);
    Route::apiResource('tours', TourController::class);

    Route::post('travels/bulk', [TravelController::class, 'bulkStore']);
    Route::post('tours/bulk', [TourController::class, 'bulkStore']);
});
