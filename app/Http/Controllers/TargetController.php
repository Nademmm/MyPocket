<?php

namespace App\Http\Controllers;

use App\Models\Target;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class TargetController extends Controller
{
    public function index()
    {
        $targets = Auth::user()->targets()->with(['logs' => function($query) {
            $query->latest()->limit(5);
        }])->latest()->paginate(10);
        return view('targets.index', compact('targets'));
    }

    public function create()
    {
        return view('targets.create');
    }

    public function store(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        try {
            $validated = $this->validateTarget($request);
            $target = $user->targets()->create($validated);

            \Log::info('Target created', [
                'target_id' => $target->id,
                'user_id' => $user->id,
            ]);

            return redirect()->route('targets.index')->with('success', 'Target created successfully.');
        } catch (Throwable $e) {
            \Log::error('Target creation failed', [
                'user_id' => $user->id,
                'message' => $e->getMessage(),
            ]);

            return back()->withInput()->withErrors([
                'error' => 'Failed to create target. Please try again.',
            ]);
        }
    }

    public function show(string $id)
    {
        $target = Auth::user()->targets()->findOrFail($id);
        return view('targets.show', compact('target'));
    }

    public function edit(string $id)
    {
        $target = Auth::user()->targets()->findOrFail($id);
        return view('targets.edit', compact('target'));
    }

    public function update(Request $request, string $id)
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        try {
            $target = $user->targets()->findOrFail($id);
            $validated = $this->validateTarget($request);

            $target->update($validated);

            return redirect()->route('targets.index')->with('success', 'Target updated successfully.');
        } catch (Throwable $e) {
            \Log::error('Target update failed', [
                'target_id' => $id,
                'user_id' => $user->id,
                'message' => $e->getMessage(),
            ]);

            return back()->withInput()->withErrors([
                'error' => 'Failed to update target. Please try again.',
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
            $target = $user->targets()->findOrFail($id);
            $target->delete();

            return redirect()->route('targets.index')->with('success', 'Target deleted successfully.');
        } catch (Throwable $e) {
            \Log::error('Target delete failed', [
                'target_id' => $id,
                'user_id' => $user->id,
                'message' => $e->getMessage(),
            ]);

            return redirect()->route('targets.index')->withErrors([
                'error' => 'Failed to delete target. Please try again.',
            ]);
        }
    }

    private function validateTarget(Request $request): array
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0.01',
            'current_amount' => 'nullable|numeric|min:0',
            'deadline' => 'required|date',
            'status' => 'required|in:active,completed,cancelled',
        ]);

        $validated['current_amount'] = $validated['current_amount'] ?? 0;

        return $validated;
    }
}
