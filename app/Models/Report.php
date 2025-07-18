<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'title',
        'description',
        'type',
        'filters',
        'file_path',
    ];

    protected $casts = [
        'filters' => 'array', // Cast filters to array for easy access
    ];
}
