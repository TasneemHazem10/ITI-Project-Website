<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    protected $fillable = [
        'course_name',
        'duration',
        'course_description',
        'skills',
        'max_students',
        'start_date',
        'location',
        'certificate',
        'featured',
        'price',
        'image',
        'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'certificate' => 'boolean',
        'featured' => 'boolean',
        'price' => 'decimal:2'
    ];

    // Relationships
    public function modules(): HasMany
    {
        return $this->hasMany(Module::class);
    }

    public function instructors(): BelongsToMany
    {
        return $this->belongsToMany(Instructor::class, 'courses_instructors');
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(CourseEnrollment::class);
    }
}
