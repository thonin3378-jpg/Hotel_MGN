<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\hotels;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class bookingController extends Controller
{
    public function index(Request $request){

        $hotel = hotels::all();
        $myRoom = Rooms::all();
        return view('FrontEnd.Booking.inputform')->with('hotel',$hotel)->with('myRoom',$myRoom);
    }
    public function store(Request $request)
    {
        // $input = $request->all();
        // dd($input);
        $request->validate([
            'room_id' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
            'adults' => 'required',
            'payment_method' => 'required',
            'total_price' => 'required',
        ]);

        Booking::create([
            'customer_id' => auth('customer')->id(),
            'room_id' => $request->room_id,
            'booking_date' => now(),
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'adults' => $request->adults,
            'payment_method' => $request->payment_method,
            'total_price' => $request->total_price,
        ]);

        return redirect()->route('home.index')->with('success', 'Booking created successfully!');
    }
}
