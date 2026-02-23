<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $balance = $user->getBalance();
        $income = $user->totalIncome();
        $expense = $user->totalExpenses();
        $targets = $user->targets()->get();
        $reminders = $user->reminders()->orderBy('remind_date')->limit(5)->get();
        $recentTransactions = $user->transactions()->orderByDesc('transaction_date')->limit(5)->get();
        return view('dashboard', compact('balance', 'income', 'expense', 'targets', 'reminders', 'recentTransactions'));
    }
}
