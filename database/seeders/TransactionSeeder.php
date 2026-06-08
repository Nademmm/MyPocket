<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\User;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'demo@mypocket.test')->first();
        if (!$user) return;

        // Create transactions
        $transactions = [
            ['type' => 'income', 'amount' => 5000000, 'description' => 'Monthly salary', 'transaction_date' => now()->subDays(15)],
            ['type' => 'expense', 'amount' => 250000, 'description' => 'Lunch with friends', 'transaction_date' => now()->subDays(5)],
            ['type' => 'expense', 'amount' => 100000, 'description' => 'Daily commute', 'transaction_date' => now()->subDays(3)],
            ['type' => 'expense', 'amount' => 150000, 'description' => 'Movie tickets', 'transaction_date' => now()->subDays(2)],
            ['type' => 'expense', 'amount' => 75000, 'description' => 'Breakfast', 'transaction_date' => now()->subDay()],
            ['type' => 'income', 'amount' => 500000, 'description' => 'Freelance project', 'transaction_date' => now()],
        ];

        foreach ($transactions as $transaction) {
            $transaction['user_id'] = $user->id;
            Transaction::create($transaction);
        }

        // Update user total_saved
        $user->total_saved = $user->totalIncome() - $user->totalExpenses();
        $user->save();
    }
}
