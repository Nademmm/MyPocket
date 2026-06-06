<?php

namespace App\Http\Controllers\Api;

use App\Models\SavingDiary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class SavingDiaryApiController extends BaseApiController
{
    public function index(): JsonResponse
    {
        $diaries = SavingDiary::where('user_id', Auth::id())
            ->orderBy('diary_date', 'desc')
            ->get();
        
        return $this->sendResponse($diaries, 'Diaries retrieved successfully.');
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:10',
            'diary_date' => 'required|date',
        ]);

        $validated['user_id'] = Auth::id();

        $diary = SavingDiary::create($validated);

        return $this->sendResponse($diary, 'Diary entry created successfully.');
    }

    public function show(string $id): JsonResponse
    {
        $diary = SavingDiary::find($id);

        if (is_null($diary) || $diary->user_id !== Auth::id()) {
            return $this->sendError('Diary not found.');
        }
        
        return $this->sendResponse($diary, 'Diary retrieved successfully.');
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $diary = SavingDiary::find($id);

        if (is_null($diary) || $diary->user_id !== Auth::id()) {
            return $this->sendError('Diary not found.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:10',
            'diary_date' => 'required|date',
        ]);

        $diary->update($validated);

        return $this->sendResponse($diary, 'Diary entry updated successfully.');
    }

    public function destroy(string $id): JsonResponse
    {
        $diary = SavingDiary::find($id);

        if (is_null($diary) || $diary->user_id !== Auth::id()) {
            return $this->sendError('Diary not found.');
        }

        $diary->delete();

        return $this->sendResponse([], 'Diary entry deleted successfully.');
    }
}
