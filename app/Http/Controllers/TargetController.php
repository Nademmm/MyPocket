<?php

namespace App\Http\Controllers;

use App\Models\Target;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TargetController extends Controller
{
    public function index()
    {
        $targets = Auth::user()->targets()->latest()->paginate(10);
        return view('targets.index', compact('targets'));
    }

    public function create()
    {
        return view('targets.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'target_amount' => 'required|numeric|min:0',
                'current_amount' => 'nullable|numeric|min:0',
                'deadline' => 'required|date',
                'status' => 'required|in:active,completed,cancelled',
            ]);

            if (is_null($validated['current_amount'])) {
                $validated['current_amount'] = 0;
            }

            $target = Auth::user()->targets()->create($validated);
            \Log::info('Target created: ' . $target->id . ' for user: ' . Auth::id());

            return redirect()->route('targets.index')->with('success', 'Target created successfully.');
        } catch (\Exception $e) {
            \Log::error('Target creation failed: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Failed to create target: ' . $e->getMessage()]);
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
        $target = Auth::user()->targets()->findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0',
            'current_amount' => 'nullable|numeric|min:0',
            'deadline' => 'required|date',
            'status' => 'required|in:active,completed,cancelled',
        ]);

        $target->update($validated);
        return redirect()->route('targets.index')->with('success', 'Target updated successfully.');
    }

    public function destroy(string $id)
    {
        $target = Auth::user()->targets()->findOrFail($id);
        $target->delete();
        return redirect()->route('targets.index')->with('success', 'Target deleted successfully.');
    }
}
