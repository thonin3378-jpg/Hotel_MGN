<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class staffs extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'hotel_id',
        'name',
        'gender',
        'position',
        'address',
        'phone',
        'email',
        'profile_photo'
    ];
    public function hotel(){
        return $this->belongsTo(hotels::class);
    }
}
