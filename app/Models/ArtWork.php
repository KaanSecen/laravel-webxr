<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtWork extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'title',
        'image',
        'sound',
        'date',
        'description'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
