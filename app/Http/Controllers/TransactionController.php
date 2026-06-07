<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Auth::user()->transactions()->latest()->paginate(10);
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('transactions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        try {
            $validated = $this->validateTransaction($request);

            $transaction = $user->transactions()->create($validated);
            $this->recalculateBalanceSafely($user);

            \Log::info('Transaction created', [
                'transaction_id' => $transaction->id,
                'user_id' => $user->id,
            ]);

            return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
        } catch (Throwable $e) {
            \Log::error('Transaction creation failed', [
                'user_id' => $user->id,
                'message' => $e->getMessage(),
            ]);

            return back()->withInput()->withErrors([
                'error' => 'Failed to create transaction. Please check your input and try again.',
            ]);
        }
    }

    public function show(string $id)
    {
        $transaction = Auth::user()->transactions()->findOrFail($id);
        return view('transactions.show', compact('transaction'));
    }

    public function edit(string $id)
    {
        $transaction = Auth::user()->transactions()->findOrFail($id);
        $categories = Category::orderBy('name')->get();
        return view('transactions.edit', compact('transaction', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        try {
            $transaction = $user->transactions()->findOrFail($id);
            $validated = $this->validateTransaction($request);

            $transaction->update($validated);
            $this->recalculateBalanceSafely($user);

            return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
        } catch (Throwable $e) {
            \Log::error('Transaction update failed', [
                'transaction_id' => $id,
                'user_id' => $user->id,
                'message' => $e->getMessage(),
            ]);

            return back()->withInput()->withErrors([
                'error' => 'Failed to update transaction. Please try again.',
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
            $transaction = $user->transactions()->findOrFail($id);
            $transaction->delete();
            $this->recalculateBalanceSafely($user);

            return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
        } catch (Throwable $e) {
            \Log::error('Transaction delete failed', [
                'transaction_id' => $id,
                'user_id' => $user->id,
                'message' => $e->getMessage(),
            ]);

            return redirect()->route('transactions.index')->withErrors([
                'error' => 'Failed to delete transaction. Please try again.',
            ]);
        }
    }

    private function validateTransaction(Request $request): array
    {
        return $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:income,expense',
            'description' => 'nullable|string',
            'transaction_date' => 'required|date',
        ]);
    }

    private function recalculateBalanceSafely($user): void
    {
        try {
            $user->updateBalance();
        } catch (Throwable $e) {
            // Keep CRUD successful even when balance recalculation has schema/data issues.
            \Log::warning('Balance recalculation failed after transaction operation', [
                'user_id' => $user->id,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
