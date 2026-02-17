<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlbumShare extends Model
{
    protected $fillable = [
        'album_id','token','name','expires_at','revoked_at',
        'view_count','last_viewed_at','created_by',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'revoked_at' => 'datetime',
        'last_viewed_at' => 'datetime',
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function isActive()
    {
        if ($this->revoked_at) return false;
        if ($this->expires_at && now()->greaterThan($this->expires_at)) return false;
        return true;
    }
}
