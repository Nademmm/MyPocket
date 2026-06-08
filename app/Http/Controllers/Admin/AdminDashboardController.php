<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Badge;
use App\Models\Target;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::where('role', 'user')->count(),
            'total_transactions' => Transaction::count(),
            'total_badges' => Badge::count(),
            'total_targets' => Target::count(),
            'total_amount_saved' => User::sum('total_saved'),
        ];

        $recent_users = User::where('role', 'user')->latest()->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_users'));
    }
}
