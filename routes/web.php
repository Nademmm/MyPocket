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
use App\Http\Controllers\TargetLogController;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('transactions', TransactionController::class);
    Route::resource('targets', TargetController::class);
    Route::post('targets/{target}/logs', [TargetLogController::class, 'store'])->name('targets.logs.store');
    Route::delete('targets/{target}/logs/{log}', [TargetLogController::class, 'destroy'])->name('targets.logs.destroy');
    Route::resource('reminders', ReminderController::class);
    Route::patch('reminders/{reminder}/toggle-active', [ReminderController::class, 'toggleActive'])->name('reminders.toggle-active');
    Route::resource('badges', BadgeController::class)->only(['index']);
    Route::resource('diaries', SavingDiaryController::class);
});



require __DIR__.'/auth.php';
