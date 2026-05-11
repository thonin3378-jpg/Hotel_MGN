<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageTestimonialController extends Controller
{
    public function index(){
        return view('FrontEnd.Pages.testimonial');
    }
}
