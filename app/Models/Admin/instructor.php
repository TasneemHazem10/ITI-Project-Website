<?php

namespace App\Models\Admin;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Instructor extends Authenticatable
{
    use Notifiable;
    protected $primaryKey = 'national_id';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'national_id',
        'email',
        'fname',
        'lname',
        'phone',
        'job_tittle',
        'img_name',
        'password'
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
