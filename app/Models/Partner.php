<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'logo',
        'short_description',
        'description',
        'address',
        'website',
        'email',
        'phone',
        'is_featured',
        'status',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function programs(): BelongsToMany
    {
        return $this->belongsToMany(Program::class, 'program_partner')->withTimestamps();
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'partner_product')
            ->withPivot('role_in_project')
            ->withTimestamps();
    }
}

