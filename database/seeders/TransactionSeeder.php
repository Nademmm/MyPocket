<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\Category;
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

        // Get categories
        $salaryCategory = Category::where('name', 'Salary')->first();
        $foodCategory = Category::where('name', 'Food & Dining')->first();
        $transportCategory = Category::where('name', 'Transportation')->first();
        $entertainmentCategory = Category::where('name', 'Entertainment')->first();

        // Create transactions
        $transactions = [
            ['category_id' => $salaryCategory->id, 'type' => 'income', 'amount' => 5000000, 'description' => 'Monthly salary', 'transaction_date' => now()->subDays(15)],
            ['category_id' => $foodCategory->id, 'type' => 'expense', 'amount' => 250000, 'description' => 'Lunch with friends', 'transaction_date' => now()->subDays(5)],
            ['category_id' => $transportCategory->id, 'type' => 'expense', 'amount' => 100000, 'description' => 'Daily commute', 'transaction_date' => now()->subDays(3)],
            ['category_id' => $entertainmentCategory->id, 'type' => 'expense', 'amount' => 150000, 'description' => 'Movie tickets', 'transaction_date' => now()->subDays(2)],
            ['category_id' => $foodCategory->id, 'type' => 'expense', 'amount' => 75000, 'description' => 'Breakfast', 'transaction_date' => now()->subDay()],
            ['category_id' => $salaryCategory->id, 'type' => 'income', 'amount' => 500000, 'description' => 'Freelance project', 'transaction_date' => now()],
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
