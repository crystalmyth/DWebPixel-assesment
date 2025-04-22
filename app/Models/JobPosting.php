<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'company_name',
        'company_logo',
        'experience',
        'salary',
        'location',
        'extra',
    ];

    protected $casts = [
        'extra' => 'array',
    ];

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
}
