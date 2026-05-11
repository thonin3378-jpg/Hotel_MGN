<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\MyUsers;
use App\Models\Rooms;
use App\Models\Services;
use App\Models\staffs;
use Illuminate\Http\Request;

class dashBoardController extends Controller
{
    public function index(){
        $totalUser = MyUsers::count();
        $totalCustomer = Customers::count();
        $myStaff = staffs::paginate(3);
        $totalRooms = Rooms::count();
        $totalService = Services::count();

        return view('BackEnd.Dashboard.index')
            ->with('totalUser',$totalUser)
            ->with('totalRooms',$totalRooms)
            ->with('totalService',$totalService)
            ->with('totalCustomer',$totalCustomer)
            ->with('myStaff',$myStaff);
    }
    
}
