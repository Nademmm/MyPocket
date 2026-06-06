<?php

namespace App\Http\Controllers\Api;

use App\Models\Target;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class TargetApiController extends BaseApiController
{
    public function index(): JsonResponse
    {
        $targets = Auth::user()->targets()->latest()->get();
        return $this->sendResponse($targets, 'Targets retrieved successfully.');
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0',
            'current_amount' => 'nullable|numeric|min:0',
            'deadline' => 'required|date',
            'status' => 'nullable|in:active,completed,cancelled',
        ]);

        $target = Auth::user()->targets()->create($validated);
        return $this->sendResponse($target, 'Target created successfully.');
    }

    public function show(string $id): JsonResponse
    {
        $target = Auth::user()->targets()->find($id);

        if (is_null($target)) {
            return $this->sendError('Target not found.');
        }

        return $this->sendResponse($target, 'Target retrieved successfully.');
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $target = Auth::user()->targets()->find($id);

        if (is_null($target)) {
            return $this->sendError('Target not found.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0',
            'current_amount' => 'nullable|numeric|min:0',
            'deadline' => 'required|date',
            'status' => 'nullable|in:active,completed,cancelled',
        ]);

        $target->update($validated);
        return $this->sendResponse($target, 'Target updated successfully.');
    }

    public function destroy(string $id): JsonResponse
    {
        $target = Auth::user()->targets()->find($id);

        if (is_null($target)) {
            return $this->sendError('Target not found.');
        }

        $target->delete();
        return $this->sendResponse([], 'Target deleted successfully.');
    }
}
