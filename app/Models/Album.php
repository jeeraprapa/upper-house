<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'image_header',
        'image_description',
        'hero_image',
        'mb_hero_image',
        'is_published',
        'published_at',
        'expires_at'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'expires_at' => 'date',
        'last_viewed_at' => 'datetime',
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class)->orderBy('sort_order')->orderBy('id');
    }

    public function shares()
    {
        return $this->hasMany(AlbumShare::class);
    }
}
