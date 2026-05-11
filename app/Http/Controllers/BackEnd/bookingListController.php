<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class bookingListController extends Controller
{
    public function index(Request $request){
        $search = $request->input('search');

        $mybooking = Booking::with(['customer', 'room'])
            ->when($search, function ($query, $search) {
                $query->whereHas('customer', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('room', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->paginate(7);

        return view('BackEnd.Settings.Clients-Booking.index', compact('mybooking'));
    }
}
