<?php

namespace App\Http\Controllers\Api;

use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class ReminderApiController extends BaseApiController
{
    public function index(): JsonResponse
    {
        $reminders = Auth::user()->reminders()->latest()->get();
        return $this->sendResponse($reminders, 'Reminders retrieved successfully.');
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'note' => 'nullable|string',
            'remind_date' => 'required|date',
            'repeat_type' => 'nullable|in:once,daily,weekly,monthly',
            'is_active' => 'nullable|boolean',
        ]);

        $reminder = Auth::user()->reminders()->create($validated);
        return $this->sendResponse($reminder, 'Reminder created successfully.');
    }

    public function show(string $id): JsonResponse
    {
        $reminder = Auth::user()->reminders()->find($id);

        if (is_null($reminder)) {
            return $this->sendError('Reminder not found.');
        }

        return $this->sendResponse($reminder, 'Reminder retrieved successfully.');
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $reminder = Auth::user()->reminders()->find($id);

        if (is_null($reminder)) {
            return $this->sendError('Reminder not found.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'note' => 'nullable|string',
            'remind_date' => 'required|date',
            'repeat_type' => 'nullable|in:once,daily,weekly,monthly',
            'is_active' => 'nullable|boolean',
        ]);

        $reminder->update($validated);
        return $this->sendResponse($reminder, 'Reminder updated successfully.');
    }

    public function destroy(string $id): JsonResponse
    {
        $reminder = Auth::user()->reminders()->find($id);

        if (is_null($reminder)) {
            return $this->sendError('Reminder not found.');
        }

        $reminder->delete();
        return $this->sendResponse([], 'Reminder deleted successfully.');
    }
}
