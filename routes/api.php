<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\TransactionApiController;
use App\Http\Controllers\Api\TargetApiController;
use App\Http\Controllers\Api\ReminderApiController;
use App\Http\Controllers\Api\SavingDiaryApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\BadgeApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::post('/login', [AuthApiController::class, 'login']);
Route::get('/categories', [CategoryApiController::class, 'index']);
Route::get('/categories/{id}', [CategoryApiController::class, 'show']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::get('/me', [AuthApiController::class, 'me']);
    Route::post('/logout', [AuthApiController::class, 'logout']);

    // Transactions
    Route::apiResource('transactions', TransactionApiController::class);

    // Targets
    Route::apiResource('targets', TargetApiController::class);

    // Reminders
    Route::apiResource('reminders', ReminderApiController::class);

    // Saving Diaries
    Route::apiResource('diaries', SavingDiaryApiController::class);

    // Badges
    Route::get('/badges', [BadgeApiController::class, 'index']);
    Route::get('/badges/{id}', [BadgeApiController::class, 'show']);
});
