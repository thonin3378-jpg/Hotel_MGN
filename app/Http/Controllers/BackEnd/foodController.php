<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\FoodCategory;
use App\Models\Foods;
use App\Models\hotels;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class foodController extends Controller
{
    public function index(Request $request){

        $search = $request->input('search');

        $myFood = Foods::when($search, function($query, $search){
            return $query->where('name', 'like', "%{$search}%");
        })->paginate(7);

        $myFoodTypeTotal = Foods::distinct('category_id')->count('category_id');
        $available = Foods::where('status','available')->count();
        $inavailable = Foods::where('status','inavailable')->count();

        $myHotel = Hotels::all();
        $myCagegory = FoodCategory::all();

        return view('BackEnd.Settings.Foods.index', compact(
            'myFoodTypeTotal',
            'available',
            'inavailable',
            'myHotel',
            'myCagegory',
            'myFood'
        ));
    }

    public function store(Request $request){
        // $input = $request->all();
        // dd($input);

        $request->validate([
            'category_id' => 'required',
            'hotel_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'discount' => 'required',
            'status' => 'required',
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $imageName = null;

        if ($request->hasFile('profile_photo')) {

            $manager = new ImageManager(new Driver());
            $imageFile = $request->file('profile_photo');

            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();

            
            $image = $manager->read($imageFile->getRealPath());

            // resize
            $resizedImage = $image
                ->resize(150, 150, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->toJpeg(80);

            file_put_contents(
                public_path('/assets/uploads/thumbnail/Foods/' . $imageName),
                (string)$resizedImage
            );
            $imageFile->move(public_path('/assets/uploads/Foods'), $imageName);
        }

        Foods::create([
            'category_id' => $request -> category_id,
            'hotel_id' => $request -> hotel_id,
            'name' => $request -> name,
            'price' => $request -> price,
            'description' => $request -> description,
            'discount' => $request -> discount,
            'status' => $request -> status,
            'profile_photo' => $imageName
        ]);

        session()->flash('success','Your Food has been inserted !');
        return redirect()->route('foods.index');
    }

    public function destroy(string $id){

        $Foods = Foods::find($id);

        if ($Foods->profile_photo && file_exists(public_path('/assets/uploads/Foods/' . $Foods->profile_photo))) {
            unlink(public_path('/assets/uploads/Foods/' . $Foods->profile_photo));
        }

        // (optional) delete thumbnail too
        if ($Foods->profile_photo && file_exists(public_path('/assets/uploads/thumbnail/Foods/' . $Foods->profile_photo))) {
            unlink(public_path('/assets/uploads/thumbnail/Foods/' . $Foods->profile_photo));
        }

        $Foods->delete();

        return redirect()->route('foods.index')->with('deleteSuccess', 'Deleted successfully!');
    }

    public function edit(string $id){

        $myFood = Foods::find($id);
        $myHotel = hotels::all();
        $myCagegory = FoodCategory::all();

        return view('BackEnd.Settings.Foods.edit-food')
            ->with('myHotel',$myHotel)
            ->with('myCagegory',$myCagegory)
            ->with('myFood',$myFood);
    }

    public function update(Request $request, string $id){
        $myFood = Foods::find($id);

        $request->validate([
            'category_id' => 'required',
            'hotel_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'discount' => 'required',
            'status' => 'required',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $myInput = $request->except('profile_photo');

        if ($request->hasFile('profile_photo')) {

            // ❗ Delete old image
            if ($myFood->profile_photo && file_exists(public_path('/assets/uploads/Foods/' . $myFood->profile_photo))) {
                unlink(public_path('/assets/uploads/Foods/' . $myFood->profile_photo));
            }

            // Upload new image
            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('/assets/uploads/Foods'), $filename);

            $myInput['profile_photo'] = $filename;
        }

        $myFood->update($myInput);

        session()->flash('success','Your Food has been updated !');
        return redirect()->route('foods.index');
    }

    public function show(string $id){
        $myFoods = Foods::find($id);

        return view('BackEnd.Settings.Foods.view-food')
            ->with('myFoods',$myFoods);
    }
}
