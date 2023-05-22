<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'intro',
        'cover_image',
        'background_image',
        'color',
        'sound',
        'category_id',
        'template',
        'date',
        'description'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function rooms()
    {
        return $this->hasMany(ArtWork::class, 'room_id');
    }
}
