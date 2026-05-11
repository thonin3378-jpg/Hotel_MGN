<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Rooms;
use App\Models\Services;
use App\Models\staffs;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $mystaff = staffs::all();
        $myCustomers = Customers::all();
        $myRooms = Rooms::with(['roomType', 'images'])->get();
        $myService = Services::all();
        
        return view('FrontEnd.Home.index')
            ->with('myCustomers',$myCustomers)
            ->with('myRooms',$myRooms)
            ->with('mystaff',$mystaff)
            ->with('myService',$myService);
    }
}
