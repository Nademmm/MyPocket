<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reminder;
use App\Models\User;

class ReminderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'demo@mypocket.test')->first();
        if (!$user) return;

        $reminders = [
            [
                'title' => 'Pay electricity bill',
                'note' => 'Don\'t forget to pay the monthly electricity bill',
                'remind_date' => now()->addDays(5)->setTime(9, 0),
                'repeat_type' => 'monthly',
                'is_active' => true,
            ],
            [
                'title' => 'Review monthly expenses',
                'note' => 'Check your spending patterns and adjust if needed',
                'remind_date' => now()->addDays(10)->setTime(18, 0),
                'repeat_type' => 'monthly',
                'is_active' => true,
            ],
            [
                'title' => 'Transfer to savings',
                'note' => 'Move 20% of this month\'s income to savings',
                'remind_date' => now()->addDays(1)->setTime(10, 0),
                'repeat_type' => 'weekly',
                'is_active' => true,
            ],
        ];

        foreach ($reminders as $reminder) {
            $reminder['user_id'] = $user->id;
            Reminder::create($reminder);
        }
    }
}
