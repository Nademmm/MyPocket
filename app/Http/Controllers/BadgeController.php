<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BadgeController extends Controller
{
    public function index()
    {
        $badges = Auth::user()->badges()->latest()->paginate(10);
        return view('badges.index', compact('badges'));
    }
    // Tambahkan method create, store, edit, update, destroy sesuai kebutuhan
}
