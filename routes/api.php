<?php

use Alexvexone\LaravelOperSms\OperSmsService;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\OTPController;
use App\Http\Controllers\Api\Dashboard\Comment\CommentController as WeddingCommentController;
use App\Http\Controllers\Api\Dashboard\Comment\CommentReplyController as WeddingCommentReplyController;
use App\Http\Controllers\Api\Dashboard\Post\Comment\CommentController as PostCommentController;
use App\Http\Controllers\Api\Dashboard\Post\Comment\CommentReplyController as PostCommentReplyController;
use App\Http\Controllers\Api\Dashboard\DashboardController;
use App\Http\Controllers\Api\Dashboard\EventController;
use App\Http\Controllers\Api\Dashboard\Faq\FaqCategoryController;
use App\Http\Controllers\Api\Dashboard\Faq\FaqController;
use App\Http\Controllers\Api\Dashboard\GalleryController;
use App\Http\Controllers\Api\Dashboard\GuestsController;
use App\Http\Controllers\Api\Dashboard\HistoryController;
use App\Http\Controllers\Api\Dashboard\PlansController;
use App\Http\Controllers\Api\Dashboard\Post\PostCategoryController;
use App\Http\Controllers\Api\Dashboard\Post\PostController;
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

    Route::get('/plan', [PlansController::class, 'index'])->middleware('role:user|admin');

    Route::prefix('guest')->middleware('role:user|admin')->group(function () {
        Route::get('/', [GuestsController::class, 'index']);
        Route::post('/', [GuestsController::class, 'store']);
        Route::put('/{guest}', [GuestsController::class, 'update']);
        Route::delete('/{guest}', [GuestsController::class, 'destroy']);
    });

//    ->middleware('role:user|admin')
    Route::prefix('wedding')->group(function () {
        Route::get('/', [WeddingController::class, 'index']);
        Route::get('/{wedding}', [WeddingController::class, 'show']);
        Route::post('/', [WeddingController::class, 'store']);
        Route::put('/{wedding}', [WeddingController::class, 'update']);

//        ->middleware(['plan.access:standard-plan-access', 'role:user|admin'])
        Route::prefix('history')->group(function () {
            Route::get('/{wedding}', [HistoryController::class, 'fetchByWedding']);
            Route::get('/show/{history}', [HistoryController::class, 'show']);
            Route::post('/', [HistoryController::class, 'store']);
            Route::put('/{history}', [HistoryController::class, 'update']);
            Route::delete('/{history}', [HistoryController::class, 'destroy']);
        });


//        ->middleware(['plan.access:premium-plan-access', 'role:user|admin'])
        Route::prefix('event')->group(function () {
            Route::get('/{wedding}', [EventController::class, 'fetchByWedding']);
            Route::get('/show/{event}', [EventController::class, 'show']);
            Route::post('/', [EventController::class, 'store']);
            Route::put('/{event}', [EventController::class, 'update']);
            Route::delete('/{event}', [EventController::class, 'destroy']);
        });

//        ->middleware(['plan.access:premium-plan-access', 'role:user|admin'])
        Route::prefix('gallery')->group(function () {
            Route::get('/{wedding}', [GalleryController::class, 'fetchByWedding']);
            Route::get('/show/{gallery}', [GalleryController::class, 'show']);
            Route::post('/', [GalleryController::class, 'store']);
            Route::put('/{gallery}', [GalleryController::class, 'update']);
            Route::delete('/{gallery}', [GalleryController::class, 'destroy']);
        });
    });

    // Statistics
    Route::prefix('statistics')->middleware(['plan.access:premium-plan-access', 'role:admin'])->group(function () {
        Route::get('/admin', [DashboardController::class, 'statisticsForAdmin']);
        Route::get('/guest-count/{weddingId}', [GuestsController::class, 'countByWedding']);
        Route::get('/comment-count/{weddingId}', [WeddingCommentController::class, 'countByWedding']);
        Route::get('/remains-wedding-date/{wedding}', [WeddingController::class, 'remainsWeddingDate']);
    });
});

// Wedding Comment
Route::prefix('wedding/comment')->middleware(['plan.access:premium-plan-access', 'role:user|admin'])->group(
    function () {
        Route::get('/{wedding}', [WeddingCommentController::class, 'fetchByWedding']);
        Route::post('/', [WeddingCommentController::class, 'store']);
        Route::put('/{comment}', [WeddingCommentController::class, 'update']);
        Route::delete('/{comment}', [WeddingCommentController::class, 'destroy']);

        Route::prefix('replay')->group(function () {
            Route::get('/{commentReply}', [WeddingCommentReplyController::class, 'fetchByComment']);
            Route::post('/', [WeddingCommentReplyController::class, 'store']);
            Route::put('/{commentReply}', [WeddingCommentReplyController::class, 'update']);
            Route::delete('/{commentReply}', [WeddingCommentReplyController::class, 'destroy']);
        });
    }
);


// FAQ
Route::prefix('faq')->group(function () {
    Route::get('/', [FaqController::class, 'index']);
    Route::get('/show/{faq}', [FaqController::class, 'show']);
    Route::get('/by-category/{faqCategory}', [FaqController::class, 'byCategory']);
    Route::post('/', [FaqController::class, 'store']);
    Route::put('/{faq}', [FaqController::class, 'update']);
    Route::delete('/{faq}', [FaqController::class, 'destroy']);

    Route::prefix('category')->group(function () {
        Route::get('/', [FaqCategoryController::class, 'index']);
        Route::get('/show/{faqCategory}', [FaqCategoryController::class, 'show']);
        Route::post('/', [FaqCategoryController::class, 'store']);
        Route::put('/{faqCategory}', [FaqCategoryController::class, 'update']);
        Route::delete('/{faqCategory}', [FaqCategoryController::class, 'destroy']);
    });
});


Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index']);
    Route::get('/show/{post}', [PostController::class, 'show']);
    Route::get('/by-category/{postCategory}', [PostController::class, 'byCategory']);
    Route::post('/', [PostController::class, 'store']);
    Route::put('/{post}', [PostController::class, 'update']);
    Route::delete('/{post}', [PostController::class, 'destroy']);

    Route::prefix('category')->group(function () {
        Route::get('/', [PostCategoryController::class, 'index']);
        Route::get('/show/{postCategory}', [PostCategoryController::class, 'show']);
        Route::post('/', [PostCategoryController::class, 'store']);
        Route::put('/{postCategory}', [PostCategoryController::class, 'update']);
        Route::delete('/{postCategory}', [PostCategoryController::class, 'destroy']);
    });

    Route::prefix('comment')->middleware(['plan.access:premium-plan-access', 'role:user|admin'])->group(function () {
        Route::get('/{wedding}', [PostCommentController::class, 'fetchByWedding']);
        Route::post('/', [PostCommentController::class, 'store']);
        Route::put('/{comment}', [PostCommentController::class, 'update']);
        Route::delete('/{comment}', [PostCommentController::class, 'destroy']);

        Route::prefix('replay')->group(function () {
            Route::get('/{commentReply}', [PostCommentReplyController::class, 'fetchByComment']);
            Route::post('/', [PostCommentReplyController::class, 'store']);
            Route::put('/{commentReply}', [PostCommentReplyController::class, 'update']);
            Route::delete('/{commentReply}', [PostCommentReplyController::class, 'destroy']);
        });
    });
});


Route::get('test-otp', function () {
    $sent = OperSmsService::send('998900868171', 'test api');
    return $sent;
});
