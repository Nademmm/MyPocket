<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TargetController extends Controller
{
    public function index()
    {
        $targets = Auth::user()->targets()->latest()->paginate(10);
        return view('targets.index', compact('targets'));
    }
    // Tambahkan method create, store, edit, update, destroy sesuai kebutuhan
}
