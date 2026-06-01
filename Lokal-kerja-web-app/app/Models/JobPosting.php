<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    protected $fillable = [
        'company_id',
        'title',
        'description',
        'location',
        'type',
        'salary',
        'status',
        'deadline',
        'requirements',
        'responsibilities',
    ];

    protected $casts = [
        'deadline' => 'date',
    ];

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
