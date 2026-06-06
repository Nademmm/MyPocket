<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SavingDiary extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'saving_diaries';

    protected $guarded = [];

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
