<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    public function index()
    {
        $reminders = Auth::user()->reminders()->latest()->paginate(10);
        return view('reminders.index', compact('reminders'));
    }
    // Tambahkan method create, store, edit, update, destroy sesuai kebutuhan
}
