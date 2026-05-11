<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hotels extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'email',
        'address',
        'status',
        'profile_photo'
    ];
    public function images()
    {
        return $this->hasMany(HotelImage::class);
    }
}
