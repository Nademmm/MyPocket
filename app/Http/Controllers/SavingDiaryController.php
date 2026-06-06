<?php

namespace App\Http\Controllers;

use App\Models\SavingDiary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

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
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        try {
            $validated = $this->validateDiary($request);

            $diary = $user->diaries()->create($validated);
            \Log::info('Diary created', [
                'diary_id' => $diary->id,
                'user_id' => $user->id,
            ]);

            return redirect()->route('diaries.index')->with('success', 'Diary entry created successfully!');
        } catch (Throwable $e) {
            \Log::error('Diary creation failed', [
                'user_id' => $user->id,
                'message' => $e->getMessage(),
            ]);

            return back()->withInput()->withErrors([
                'error' => 'Failed to create diary entry. Please try again.',
            ]);
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
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        try {
            $diary = $user->diaries()->findOrFail($id);
            $validated = $this->validateDiary($request);

            $diary->update($validated);

            return redirect()->route('diaries.index')->with('success', 'Diary entry updated successfully!');
        } catch (Throwable $e) {
            \Log::error('Diary update failed', [
                'diary_id' => $id,
                'user_id' => $user->id,
                'message' => $e->getMessage(),
            ]);

            return back()->withInput()->withErrors([
                'error' => 'Failed to update diary entry. Please try again.',
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
            $diary = $user->diaries()->findOrFail($id);
            $diary->delete();

            return redirect()->route('diaries.index')->with('success', 'Diary entry deleted successfully!');
        } catch (Throwable $e) {
            \Log::error('Diary delete failed', [
                'diary_id' => $id,
                'user_id' => $user->id,
                'message' => $e->getMessage(),
            ]);

            return redirect()->route('diaries.index')->withErrors([
                'error' => 'Failed to delete diary entry. Please try again.',
            ]);
        }
    }

    private function validateDiary(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:10',
            'diary_date' => 'required|date',
        ]);
    }
}
