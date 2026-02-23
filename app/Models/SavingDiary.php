<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SavingDiary extends Model
{
    use HasFactory;

    protected $table = 'saving_diaries';

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'diary_date',
    ];

    protected function casts(): array
    {
        return [
            'diary_date' => 'date',
        ];
    }

    /**
     * Get the user that owns this diary entry.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
