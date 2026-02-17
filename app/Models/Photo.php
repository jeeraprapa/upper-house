<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'album_id','image_path','caption','sort_order','is_published','taken_at'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'taken_at' => 'datetime',
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
