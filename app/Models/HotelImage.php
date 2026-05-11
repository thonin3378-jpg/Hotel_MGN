<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelImage extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'hotel_id',
        'profile_photo'
    ];
    // public function hotel()
    // {
    //     return $this->belongsTo(hotels::class);
    // }
    public function hotel(){
        return $this->belongsTo(hotels::class, 'hotel_id');
    }
}
