<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'media_type',
        'media_path',
        'thumbnail_path',
        'sort_order',
        'is_active',
        'published_at',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function uploader()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

