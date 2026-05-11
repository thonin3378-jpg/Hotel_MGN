<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class recieptController extends Controller
{
     public function index(){
         $booking = Booking::where('customer_id', auth('customer')->id())->get();

        return view('FrontEnd.Booking.Receipt', compact('booking'));
    }
    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        return view('FrontEnd.Booking.Receipt', compact('booking'));
    }
}
