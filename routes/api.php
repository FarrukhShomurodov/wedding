<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\OTPController;
use App\Http\Controllers\Api\Dashboard\GuestsController;
use App\Http\Controllers\Api\Dashboard\User\PlansController;
use App\Http\Controllers\Api\Dashboard\WeddingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/send-otp', [OTPController::class, 'sendOTP']);
Route::post('/verify-otp', [OTPController::class, 'checkCode']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/plan', [PlansController::class, 'index']);

    Route::prefix('guest')->group(function () {
        Route::get('/', [GuestsController::class, 'index']);
        Route::post('/', [GuestsController::class, 'store']);
        Route::put('/{guest}', [GuestsController::class, 'update']);
        Route::delete('/{guest}', [GuestsController::class, 'destroy']);
    });

    Route::prefix('wedding')->group(function () {
        Route::get('/', [WeddingController::class, 'index']);
        Route::get('/{wedding}', [WeddingController::class, 'show']);
        Route::post('/', [WeddingController::class, 'store']);
        Route::put('/{wedding}', [WeddingController::class, 'update']);
    });
});
