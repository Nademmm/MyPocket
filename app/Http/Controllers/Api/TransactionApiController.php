<?php

namespace App\Http\Controllers\Api;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class TransactionApiController extends BaseApiController
{
    public function index(): JsonResponse
    {
        $transactions = Auth::user()->transactions()->with('category')->latest()->get();
        return $this->sendResponse($transactions, 'Transactions retrieved successfully.');
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'type' => 'required|in:income,expense',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'transaction_date' => 'required|date',
        ]);

        $transaction = Auth::user()->transactions()->create($validated);
        return $this->sendResponse($transaction->load('category'), 'Transaction created successfully.');
    }

    public function show(string $id): JsonResponse
    {
        $transaction = Auth::user()->transactions()->with('category')->find($id);

        if (is_null($transaction)) {
            return $this->sendError('Transaction not found.');
        }

        return $this->sendResponse($transaction, 'Transaction retrieved successfully.');
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $transaction = Auth::user()->transactions()->find($id);

        if (is_null($transaction)) {
            return $this->sendError('Transaction not found.');
        }

        $validated = $request->validate([
            'amount' => 'required|numeric',
            'type' => 'required|in:income,expense',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'transaction_date' => 'required|date',
        ]);

        $transaction->update($validated);
        return $this->sendResponse($transaction->load('category'), 'Transaction updated successfully.');
    }

    public function destroy(string $id): JsonResponse
    {
        $transaction = Auth::user()->transactions()->find($id);

        if (is_null($transaction)) {
            return $this->sendError('Transaction not found.');
        }

        $transaction->delete();
        return $this->sendResponse([], 'Transaction deleted successfully.');
    }
}
