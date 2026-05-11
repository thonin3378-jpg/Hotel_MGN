<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Rooms;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    public function index(){
        $myRooms = Rooms::with(['roomType', 'images'])->get();
        return view('FrontEnd.Rooms.index')->with('myRooms',$myRooms);
    }
}
