<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClinicProfile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'short_name',
        'slug',
        'description',
        'vision',
        'mission',
        'history',
        'logo_path',
        'cover_path',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}

