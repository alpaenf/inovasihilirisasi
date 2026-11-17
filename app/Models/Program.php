<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'full_name',
        'slug',
        'code',
        'short_description',
        'description',
        'objectives',
        'location',
        'commodities',
        'focus_activities',
        'student_needs',
        'logo',
        'banner',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'commodities' => 'array',
        'focus_activities' => 'array',
        'student_needs' => 'array',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function partners(): BelongsToMany
    {
        return $this->belongsToMany(Partner::class, 'program_partner')->withTimestamps();
    }
}

