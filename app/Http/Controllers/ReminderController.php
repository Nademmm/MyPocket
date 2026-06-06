<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

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
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        try {
            $validated = $this->validateReminder($request);
            $validated['is_active'] = $request->has('is_active');

            $reminder = $user->reminders()->create($validated);
            \Log::info('Reminder created', [
                'reminder_id' => $reminder->id,
                'user_id' => $user->id,
            ]);

            return redirect()->route('reminders.index')->with('success', 'Reminder created successfully.');
        } catch (Throwable $e) {
            \Log::error('Reminder creation failed', [
                'user_id' => $user->id,
                'message' => $e->getMessage(),
            ]);

            return back()->withInput()->withErrors([
                'error' => 'Failed to create reminder. Please try again.',
            ]);
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
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        try {
            $reminder = $user->reminders()->findOrFail($id);
            $validated = $this->validateReminder($request);
            $validated['is_active'] = $request->has('is_active');

            $reminder->update($validated);

            return redirect()->route('reminders.index')->with('success', 'Reminder updated successfully.');
        } catch (Throwable $e) {
            \Log::error('Reminder update failed', [
                'reminder_id' => $id,
                'user_id' => $user->id,
                'message' => $e->getMessage(),
            ]);

            return back()->withInput()->withErrors([
                'error' => 'Failed to update reminder. Please try again.',
            ]);
        }
    }

    public function destroy(string $id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        try {
            $reminder = $user->reminders()->findOrFail($id);
            $reminder->delete();

            return redirect()->route('reminders.index')->with('success', 'Reminder deleted successfully.');
        } catch (Throwable $e) {
            \Log::error('Reminder delete failed', [
                'reminder_id' => $id,
                'user_id' => $user->id,
                'message' => $e->getMessage(),
            ]);

            return redirect()->route('reminders.index')->withErrors([
                'error' => 'Failed to delete reminder. Please try again.',
            ]);
        }
    }

    public function toggleActive(string $id)
    {
        try {
            $reminder = Auth::user()->reminders()->findOrFail($id);
            $reminder->toggleActive();

            return back()->with('success', 'Reminder status updated.');
        } catch (Throwable $e) {
            return back()->withErrors(['error' => 'Failed to update reminder status.']);
        }
    }

    private function validateReminder(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'note' => 'nullable|string',
            'remind_date' => 'required|date_format:Y-m-d\TH:i',
            'repeat_type' => 'required|in:once,daily,weekly,monthly',
            'is_active' => 'nullable|boolean',
        ]);
    }
}
