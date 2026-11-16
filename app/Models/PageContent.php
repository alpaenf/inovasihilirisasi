<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_key',
        'section_key',
        'title',
        'content',
        'image',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];
}

