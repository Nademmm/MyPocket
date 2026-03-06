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

    public function create()
    {
        return view('reminders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'note' => 'nullable|string',
            'remind_date' => 'required|date',
            'repeat_type' => 'nullable|in:once,daily,weekly,monthly',
            'is_active' => 'nullable|boolean',
        ]);

        Auth::user()->reminders()->create($validated);
        return redirect()->route('reminders.index')->with('success', 'Reminder created successfully.');
    }

    public function show(string $id)
    {
        $reminder = Auth::user()->reminders()->findOrFail($id);
        return view('reminders.show', compact('reminder'));
    }

    public function edit(string $id)
    {
        $reminder = Auth::user()->reminders()->findOrFail($id);
        return view('reminders.edit', compact('reminder'));
    }

    public function update(Request $request, string $id)
    {
        $reminder = Auth::user()->reminders()->findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'note' => 'nullable|string',
            'remind_date' => 'required|date',
            'repeat_type' => 'nullable|in:once,daily,weekly,monthly',
            'is_active' => 'nullable|boolean',
        ]);

        $reminder->update($validated);
        return redirect()->route('reminders.index')->with('success', 'Reminder updated successfully.');
    }

    public function destroy(string $id)
    {
        $reminder = Auth::user()->reminders()->findOrFail($id);
        $reminder->delete();
        return redirect()->route('reminders.index')->with('success', 'Reminder deleted successfully.');
    }
}
