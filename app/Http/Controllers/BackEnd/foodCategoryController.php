<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\FoodCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class foodCategoryController extends Controller
{
    public function store(Request $request){

        // $input = $request->all();
        // dd($input);

        $request->validate([
            'name' => 'required'
        ]);

        FoodCategory::create([
            'name' => $request -> name
        ]);

        session()->flash('success','Your data has been inserted !');
        return redirect()->route('foods.index');
    }
}
