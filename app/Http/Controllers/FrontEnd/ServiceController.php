<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(){
        $myService = Services::all();
        return view('FrontEnd.Service.index')->with('myService',$myService);
    }
}
