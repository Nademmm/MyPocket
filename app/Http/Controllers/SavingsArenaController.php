<?php

namespace App\Http\Controllers;

use App\Models\Target;
use Illuminate\Http\Request;

class SavingsArenaController extends Controller
{
    public function index()
    {
        $targets = Target::where('is_published', true)
            ->where('status', 'active')
            ->with('user')
            ->latest()
            ->get();

        return view('savings-arena.index', compact('targets'));
    }
}
