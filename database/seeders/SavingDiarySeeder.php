<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SavingDiary;
use App\Models\User;

class SavingDiarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'demo@mypocket.test')->first();
        if (!$user) return;

        $diaries = [
            [
                'title' => 'My First Day with MyPocket',
                'content' => 'Started using MyPocket today! I\'m excited to track my finances properly. My goal is to save at least Rp 10 million by the end of the year. I believe with consistent tracking, I can achieve this goal.',
                'diary_date' => now()->subDays(10),
            ],
            [
                'title' => 'Reducing expenses',
                'content' => 'I realized I spend too much on food and entertainment. Starting this week, I\'ll reduce dining out to twice a week. This should help me save more money for my emergency fund.',
                'diary_date' => now()->subDays(5),
            ],
            [
                'title' => 'Small wins!',
                'content' => 'Just completed my first small saving goal! I managed to save Rp 2.5 million in just 2 weeks. Feeling motivated to continue!',
                'diary_date' => now(),
            ],
        ];

        foreach ($diaries as $diary) {
            $diary['user_id'] = $user->id;
            SavingDiary::create($diary);
        }
    }
}
