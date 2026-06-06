<?php

namespace App\Http\Controllers;

use App\Models\SavingDiary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SavingDiaryController extends Controller
{
    public function index()
    {
        $diaries = Auth::user()->diaries()
            ->orderBy('diary_date', 'desc')
            ->paginate(10);
        
        return view('diaries.index', compact('diaries'));
    }

    public function create()
    {
        return view('diaries.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string|min:10',
                'diary_date' => 'required|date',
            ]);

            $diary = Auth::user()->diaries()->create($validated);
            \Log::info('Diary created: ' . $diary->id . ' for user: ' . Auth::id());

            return redirect()->route('diaries.index')->with('success', 'Diary entry created successfully!');
        } catch (\Exception $e) {
            \Log::error('Diary creation failed: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Failed to create diary entry: ' . $e->getMessage()]);
        }
    }

    public function show(string $id)
    {
        $diary = Auth::user()->diaries()->findOrFail($id);
        return view('diaries.show', compact('diary'));
    }

    public function edit(string $id)
    {
        $diary = Auth::user()->diaries()->findOrFail($id);
        return view('diaries.edit', compact('diary'));
    }

    public function update(Request $request, string $id)
    {
        $diary = Auth::user()->diaries()->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:10',
            'diary_date' => 'required|date',
        ]);

        $diary->update($validated);

        return redirect()->route('diaries.index')->with('success', 'Diary entry updated successfully!');
    }

    public function destroy(string $id)
    {
        $diary = Auth::user()->diaries()->findOrFail($id);
        $diary->delete();

        return redirect()->route('diaries.index')->with('success', 'Diary entry deleted successfully!');
    }
}
