<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Badge;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $badges = [
            [
                'name' => 'First Transaction',
                'description' => 'Create your first transaction in MyPocket',
                'requirement_type' => 'transaction_count',
                'requirement_value' => 1,
            ],
            [
                'name' => 'Consistent Tracker',
                'description' => 'Track 50 transactions to build a financial habit',
                'requirement_type' => 'transaction_count',
                'requirement_value' => 50,
            ],
            [
                'name' => 'First Goal Reached',
                'description' => 'Complete your first saving target',
                'requirement_type' => 'target_count',
                'requirement_value' => 1,
            ],
            [
                'name' => 'Target Master',
                'description' => 'Successfully complete 5 saving targets',
                'requirement_type' => 'target_count',
                'requirement_value' => 5,
            ],
            [
                'name' => 'Wealth Builder',
                'description' => 'Save a total of Rp 1.000.000 across all targets',
                'requirement_type' => 'total_savings',
                'requirement_value' => 1000000,
            ],
            [
                'name' => 'Sultan MyPocket',
                'description' => 'Reach a total savings of Rp 10.000.000',
                'requirement_type' => 'total_savings',
                'requirement_value' => 10000000,
            ],
        ];

        foreach ($badges as $badge) {
            Badge::updateOrCreate(
                ['name' => $badge['name']],
                $badge
            );
        }
    }
}
