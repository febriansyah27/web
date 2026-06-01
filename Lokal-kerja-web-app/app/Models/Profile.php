<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
        'user_id',
        'bio',
        'phone',
        'alamat',
        'job_title',
        'location',
        'skills',
        'experience',
        'education',
    ])]

class Profile extends Model
{
    protected $casts = [
        'skills' => 'array',
        'experience' => 'array',
        'education' => 'array'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
