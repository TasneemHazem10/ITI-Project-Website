<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use Notifiable;

    protected $table = 'students';

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'university',
        'password',
        'profile_image',
        'is_verified'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Constants for verification status
    const VERIFICATION_PENDING = '2'; // Awaiting photo upload
    const VERIFICATION_UNDER_REVIEW = '1'; // Photo uploaded, under admin review
    const VERIFICATION_APPROVED = '0'; // Approved by admin

    public function isVerified()
    {
        return $this->is_verified === self::VERIFICATION_APPROVED;
    }

    public function isUnderReview()
    {
        return $this->is_verified === self::VERIFICATION_UNDER_REVIEW;
    }

    public function isPending()
    {
        return $this->is_verified === self::VERIFICATION_PENDING;
    }
}
