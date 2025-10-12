<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category',
        'image',
        'gallery',
        'tools',
        'github',
        'demo',
        'featured',
    ];

    protected function casts(): array
    {
        return [
            'gallery' => 'array',
            'tools' => 'array',
            'featured' => 'boolean',
        ];
    }
}
