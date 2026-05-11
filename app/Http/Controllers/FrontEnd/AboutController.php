<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\staffs;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(){
        $mystaff = staffs::all();
        return view('FrontEnd.about.index')->with('mystaff',$mystaff);
    }
}
