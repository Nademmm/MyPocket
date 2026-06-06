<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Auth::user()->transactions()->latest()->paginate(10);
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('transactions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'amount' => 'required|numeric',
                'type' => 'required|in:income,expense',
                'category_id' => 'required|exists:categories,id',
                'description' => 'nullable|string',
                'transaction_date' => 'required|date',
            ]);

            DB::transaction(function () use ($validated) {
                $user = Auth::user();
                $transaction = $user->transactions()->create($validated);
                $user->updateBalance();
                \Log::info('Transaction created: ' . $transaction->id . ' for user: ' . $user->id);
            });

            return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
        } catch (\Exception $e) {
            \Log::error('Transaction creation failed: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Failed to create transaction: ' . $e->getMessage()]);
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
        $categories = Category::all();
        return view('transactions.edit', compact('transaction', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $transaction = Auth::user()->transactions()->findOrFail($id);
        
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'type' => 'required|in:income,expense',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'transaction_date' => 'required|date',
        ]);

        DB::transaction(function () use ($transaction, $validated) {
            $transaction->update($validated);
            Auth::user()->updateBalance();
        });

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(string $id)
    {
        $transaction = Auth::user()->transactions()->findOrFail($id);
        
        DB::transaction(function () use ($transaction) {
            $transaction->delete();
            Auth::user()->updateBalance();
        });

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
