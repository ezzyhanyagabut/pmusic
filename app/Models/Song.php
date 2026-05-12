<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
protected $fillable = [
        'title',
        'youtube_id',
        'duration',
        'likes',
        'album_id',
        'artist_id',
        'is_trending'
    ];

    public function album()
{
    return $this->belongsTo(Album::class);
}

public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

public function likes()
{
    return $this->hasMany(Like::class);
}

public function bookmarks()
{
    return $this->hasMany(Bookmark::class);
}
}
