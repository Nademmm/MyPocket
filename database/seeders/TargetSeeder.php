<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Target;
use App\Models\User;

class TargetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'demo@mypocket.test')->first();
        if (!$user) return;

        $targets = [
            [
                'title' => 'Emergency Fund',
                'target_amount' => 10000000,
                'current_amount' => 2500000,
                'deadline' => now()->addMonths(6),
                'status' => 'active',
            ],
            [
                'title' => 'Vacation Fund',
                'target_amount' => 5000000,
                'current_amount' => 1500000,
                'deadline' => now()->addMonths(3),
                'status' => 'active',
            ],
            [
                'title' => 'New Laptop',
                'target_amount' => 15000000,
                'current_amount' => 0,
                'deadline' => now()->addMonths(12),
                'status' => 'active',
            ],
        ];

        foreach ($targets as $target) {
            $target['user_id'] = $user->id;
            Target::create($target);
        }
    }
}
