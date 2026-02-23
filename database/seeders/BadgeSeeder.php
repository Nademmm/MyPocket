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
                'name' => 'First Step',
                'icon' => '🚀',
                'description' => 'Create your first transaction',
                'requirement' => 'transactions_1',
            ],
            [
                'name' => 'Consistent Tracker',
                'icon' => '📈',
                'description' => 'Track 50 transactions',
                'requirement' => 'transactions_50',
            ],
            [
                'name' => 'Money Saver',
                'icon' => '💰',
                'description' => 'Save Rp 1.000.000',
                'requirement' => 'total_saved_1000000',
            ],
            [
                'name' => 'Big Saver',
                'icon' => '💎',
                'description' => 'Save Rp 10.000.000',
                'requirement' => 'total_saved_10000000',
            ],
            [
                'name' => 'Target Master',
                'icon' => '🎯',
                'description' => 'Complete 5 targets',
                'requirement' => 'targets_completed_5',
            ],
            [
                'name' => 'Daily Journaler',
                'icon' => '📔',
                'description' => 'Write 10 diary entries',
                'requirement' => 'diaries_10',
            ],
        ];

        foreach ($badges as $badge) {
            Badge::firstOrCreate(
                ['name' => $badge['name']],
                $badge
            );
        }
    }
}
