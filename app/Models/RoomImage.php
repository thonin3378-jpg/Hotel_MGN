<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomImage extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'room_id',
        'profile_photo'
    ];
    public function room()
    {
        return $this->belongsTo(Rooms::class, 'room_id');
    }
}
