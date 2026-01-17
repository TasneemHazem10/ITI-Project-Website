<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    protected $fillable = [
        'ordered_day',
        'order_index',
        'module_id',
        'lesson_title',
        'lesson_content',
        'duration_minutes',
        'video_url',
        'is_free'
    ];

    protected $casts = [
        'is_free' => 'boolean'
    ];

    // Relationships
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }
}
