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

    public function create()
    {
        return view('targets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0',
            'current_amount' => 'nullable|numeric|min:0',
            'deadline' => 'required|date',
            'status' => 'nullable|in:active,completed,cancelled',
        ]);

        Auth::user()->targets()->create($validated);
        return redirect()->route('targets.index')->with('success', 'Target created successfully.');
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
            'status' => 'nullable|in:active,completed,cancelled',
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
