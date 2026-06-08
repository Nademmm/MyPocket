<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BadgeController extends Controller
{
    public function index()
    {
        $badges = Badge::latest()->paginate(10);
        return view('admin.badges.index', compact('badges'));
    }

    public function create()
    {
        return view('admin.badges.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'requirement_type' => 'required|in:target_count,transaction_count,total_savings',
            'requirement_value' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('badges', 'public');
            $validated['image_path'] = $path;
        }

        Badge::create($validated);

        return redirect()->route('admin.badges.index')->with('success', 'Badge created successfully.');
    }

    public function edit(Badge $badge)
    {
        return view('admin.badges.edit', compact('badge'));
    }

    public function update(Request $request, Badge $badge)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'requirement_type' => 'required|in:target_count,transaction_count,total_savings',
            'requirement_value' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($badge->image_path) {
                Storage::disk('public')->delete($badge->image_path);
            }
            $path = $request->file('image')->store('badges', 'public');
            $validated['image_path'] = $path;
        }

        $badge->update($validated);

        return redirect()->route('admin.badges.index')->with('success', 'Badge updated successfully.');
    }

    public function destroy(Badge $badge)
    {
        if ($badge->image_path) {
            Storage::disk('public')->delete($badge->image_path);
        }
        $badge->delete();
        return back()->with('success', 'Badge deleted successfully.');
    }
}
