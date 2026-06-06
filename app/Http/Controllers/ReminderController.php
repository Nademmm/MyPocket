<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'note' => 'nullable|string',
                'remind_date' => 'required|date_format:Y-m-d\TH:i',
                'repeat_type' => 'required|in:once,daily,weekly,monthly',
                'is_active' => 'nullable|boolean',
            ]);

            if (!$request->has('is_active')) {
                $validated['is_active'] = true;
            }

            $reminder = Auth::user()->reminders()->create($validated);
            \Log::info('Reminder created: ' . $reminder->id . ' for user: ' . Auth::id());

            return redirect()->route('reminders.index')->with('success', 'Reminder created successfully.');
        } catch (\Exception $e) {
            \Log::error('Reminder creation failed: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Failed to create reminder: ' . $e->getMessage()]);
        }
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
            'remind_date' => 'required|date_format:Y-m-d\TH:i',
            'repeat_type' => 'required|in:once,daily,weekly,monthly',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

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
