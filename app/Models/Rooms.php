<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'hotel_id',
        'room_types_id',
        'name',
        'status',
        'detail'
    ];

    public function hotel(){
        return $this->belongsTo(hotels::class);
    }
    public function roomType(){
        return $this->belongsTo(RoomTypes::class,'room_types_id');
    }
    public function images()
    {
        return $this->hasMany(RoomImage::class, 'room_id');
    }
}
