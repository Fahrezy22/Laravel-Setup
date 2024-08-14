<?php

use App\Http\Controllers\Api\V1\EmployeeJobController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('employee')->group(function () {
    Route::prefix('jobs')->group(function () {
        Route::get('/', [EmployeeJobController::class, 'index']);
        Route::prefix('{id}')->group(function(){
            Route::get('', [EmployeeJobController::class, 'show']);
            Route::put('', [EmployeeJobController::class, 'update']);
            Route::delete('', [EmployeeJobController::class, 'destroy']);
        });
        Route::post('', [EmployeeJobController::class, 'store']);
    });
});
