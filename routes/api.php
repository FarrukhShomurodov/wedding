<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\OTPController;
use App\Http\Controllers\Api\Dashboard\CommentController;
use App\Http\Controllers\Api\Dashboard\EventController;
use App\Http\Controllers\Api\Dashboard\GalleryController;
use App\Http\Controllers\Api\Dashboard\GuestsController;
use App\Http\Controllers\Api\Dashboard\HistoryController;
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

        Route::prefix('history')->group(function () {
            Route::get('/{wedding}', [HistoryController::class, 'fetchByWedding']);
            Route::get('/show/{history}', [HistoryController::class, 'show']);
            Route::post('/', [HistoryController::class, 'store']);
            Route::put('/{history}', [HistoryController::class, 'update']);
            Route::delete('/{history}', [HistoryController::class, 'destroy']);
        });

        Route::prefix('comment')->group(function () {
            Route::get('/{wedding}', [CommentController::class, 'fetchByWedding']);
            Route::post('/', [CommentController::class, 'store']);
            Route::put('/{comment}', [CommentController::class, 'update']);
            Route::delete('/{comment}', [CommentController::class, 'destroy']);
        });

        Route::prefix('event')->group(function () {
            Route::get('/{wedding}', [EventController::class, 'fetchByWedding']);
            Route::get('/show/{event}', [EventController::class, 'show']);
            Route::post('/', [EventController::class, 'store']);
            Route::put('/{event}', [EventController::class, 'update']);
            Route::delete('/{event}', [EventController::class, 'destroy']);
        });

        Route::prefix('gallery')->group(function () {
            Route::get('/{wedding}', [GalleryController::class, 'fetchByWedding']);
            Route::get('/show/{gallery}', [GalleryController::class, 'show']);
            Route::post('/', [GalleryController::class, 'store']);
            Route::put('/{gallery}', [GalleryController::class, 'update']);
            Route::delete('/{gallery}', [GalleryController::class, 'destroy']);
        });
    });
});
