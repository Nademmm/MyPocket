<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create demo user
        User::factory()->create([
            'name' => 'Demo User',
            'email' => 'demo@mypocket.test',
            'password' => bcrypt('password'),
            'role' => 'user',
            'level' => 1,
        ]);

        // Create admin user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@mypocket.test',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'level' => 10,
        ]);

        // Run additional seeders
        $this->call([
            CategorySeeder::class,
            BadgeSeeder::class,
            TransactionSeeder::class,
            TargetSeeder::class,
            ReminderSeeder::class,
            SavingDiarySeeder::class,
        ]);
    }
}
