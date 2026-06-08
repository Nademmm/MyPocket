<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'total_saved',
        'level',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'total_saved' => 'decimal:2',
        ];
    }

    /**
     * Get all transactions for the user.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get all targets for the user.
     */
    public function targets(): HasMany
    {
        return $this->hasMany(Target::class);
    }

    /**
     * Get all reminders for the user.
     */
    public function reminders(): HasMany
    {
        return $this->hasMany(Reminder::class);
    }

    /**
     * Get all diary entries for the user.
     */
    public function diaries()
    {
        return $this->hasMany(SavingDiary::class);
    }

    /**
     * Get all badges earned by the user.
     */
    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'user_badges')->withTimestamps()->withPivot('earned_at');
    }

    public function updateBalance(): void
    {
        $income = $this->totalIncome();
        $expense = $this->totalExpenses();
        $savings = $this->totalSavings();
        
        // This method seems to be used to refresh cached values if needed, 
        // but let's make it consistent with the new logic.
        $this->update(['total_saved' => $savings]);

        $this->checkAndAwardBadges();
    }

    /**
     * Check and award badges based on user activity.
     */
    public function checkAndAwardBadges(): void
    {
        $earnedBadgeIds = $this->badges()->pluck('badges.id')->toArray();
        $allBadges = Badge::all();

        foreach ($allBadges as $badge) {
            if (in_array($badge->id, $earnedBadgeIds)) {
                continue;
            }

            $shouldAward = false;

            switch ($badge->requirement_type) {
                case 'transaction_count':
                    if ($this->transactions()->count() >= $badge->requirement_value) {
                        $shouldAward = true;
                    }
                    break;
                case 'target_count':
                    if ($this->targets()->where('status', 'completed')->count() >= $badge->requirement_value) {
                        $shouldAward = true;
                    }
                    break;
                case 'total_savings':
                    if ($this->totalSavings() >= $badge->requirement_value) {
                        $shouldAward = true;
                    }
                    break;
            }

            if ($shouldAward) {
                $this->badges()->attach($badge->id, ['earned_at' => now()]);
            }
        }
    }

    /**
     * Check if user is admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Calculate total income for the user.
     */
    public function totalIncome(): float
    {
        return $this->transactions()
            ->where('type', 'income')
            ->sum('amount');
    }

    /**
     * Calculate total expenses for the user.
     */
    public function totalExpenses(): float
    {
        return $this->transactions()
            ->where('type', 'expense')
            ->sum('amount');
    }

    /**
     * Calculate total savings from all targets.
     */
    public function totalSavings(): float
    {
        return $this->targets()->sum('current_amount');
    }

    /**
     * Get balance = (income - expenses) - savings.
     */
    public function getBalance(): float
    {
        return $this->totalIncome() - $this->totalExpenses() - $this->totalSavings();
    }
}
