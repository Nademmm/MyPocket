<?php

namespace App\Http\Controllers\Api;

use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class BadgeApiController extends BaseApiController
{
    public function index(): JsonResponse
    {
        $badges = Auth::user()->badges()->latest()->get();
        return $this->sendResponse($badges, 'Badges retrieved successfully.');
    }

    public function show(string $id): JsonResponse
    {
        $badge = Auth::user()->badges()->find($id);

        if (is_null($badge)) {
            return $this->sendError('Badge not found.');
        }

        return $this->sendResponse($badge, 'Badge retrieved successfully.');
    }
}
