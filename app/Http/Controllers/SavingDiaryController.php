<?php

namespace App\Http\Controllers;

use App\Models\SavingDiary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavingDiaryController extends Controller
{
    public function index()
    {
        $diaries = SavingDiary::where('user_id', Auth::id())
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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:10',
            'diary_date' => 'required|date',
        ]);

        $validated['user_id'] = Auth::id();

        SavingDiary::create($validated);

        return redirect()->route('diaries.index')->with('success', 'Diary entry created successfully!');
    }

    public function show(SavingDiary $diary)
    {
        if ($diary->user_id !== Auth::id()) {
            abort(403);
        }
        
        return view('diaries.show', compact('diary'));
    }

    public function edit(SavingDiary $diary)
    {
        if ($diary->user_id !== Auth::id()) {
            abort(403);
        }
        
        return view('diaries.edit', compact('diary'));
    }

    public function update(Request $request, SavingDiary $diary)
    {
        if ($diary->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:10',
            'diary_date' => 'required|date',
        ]);

        $diary->update($validated);

        return redirect()->route('diaries.index')->with('success', 'Diary entry updated successfully!');
    }

    public function destroy(SavingDiary $diary)
    {
        if ($diary->user_id !== Auth::id()) {
            abort(403);
        }

        $diary->delete();

        return redirect()->route('diaries.index')->with('success', 'Diary entry deleted successfully!');
    }
}
