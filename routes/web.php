<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\SavingDiaryController;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('transactions', TransactionController::class);
    Route::resource('targets', TargetController::class);
    Route::resource('reminders', ReminderController::class);
    Route::resource('badges', BadgeController::class);
    Route::resource('diaries', SavingDiaryController::class);
});



require __DIR__.'/auth.php';
