<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Transaction;
use App\Models\Target;
use App\Models\Reminder;
use App\Models\SavingDiary;
use App\Models\Badge;
use App\Policies\TransactionPolicy;
use App\Policies\TargetPolicy;
use App\Policies\ReminderPolicy;
use App\Policies\BadgePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Transaction::class => TransactionPolicy::class,
        Target::class => TargetPolicy::class,
        Reminder::class => ReminderPolicy::class,
        SavingDiary::class => BadgePolicy::class,
        Badge::class => BadgePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
