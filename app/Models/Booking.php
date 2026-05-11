<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
   use HasFactory;

    protected $fillable = [
        'customer_id',
        'room_id',
        'booking_date',
        'check_in',
        'check_out',
        'adults',
        'total_price',
        'payment_method',
    ];

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }

    public function room()
    {
        return $this->belongsTo(Rooms::class, 'room_id');
    }
}
