<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reminder extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'note',
        'remind_date',
        'repeat_type',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string|bool>
     */
    protected function casts(): array
    {
        return [
            'remind_date' => 'datetime',
            'is_active' => 'boolean',
            'repeat_type' => 'string',
        ];
    }

    /**
     * Get the user that owns this reminder.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Toggle the active status of the reminder.
     */
    public function toggleActive(): void
    {
        $this->update(['is_active' => !$this->is_active]);
    }
}
