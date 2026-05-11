<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomTypes extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'price',
        'bed',
        'bath',
        'wifi',
        'status',
        'profile_photo'
    ];
   public function room(){
    return $this->hasMany(Rooms::class, 'room_types_id');
   }
}
