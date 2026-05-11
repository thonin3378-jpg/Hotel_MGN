<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\HotelImage;
use App\Models\hotels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Colors\Rgb\Channels\Red;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class hotelController extends Controller
{
    public function index(Request $request){

       $search = $request->input('search');

        $myHotel = hotels::when($search, function($query, $search){
            return $query->where('address','like', "%{$search}%");
        })->paginate(7);

        $hotelImage = HotelImage::with('hotel')->paginate(5);

        $bookingCount = hotels::where('status', 0)->count();
        $freeCount    = hotels::where('status', 1)->count();
        $provinceCount = hotels::distinct('address')->count('address');

        return view('BackEnd.Settings.Home-Hotel.index', compact(
            'myHotel',
            'hotelImage',
            'bookingCount',
            'freeCount',
            'provinceCount'
        ));
    }

    public function store(Request $request){
        // $myInput = $request->all();
        // dd($myInput);

        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        
        $imageName = null;

        if ($request->hasFile('profile_photo')) {
            $manager = new ImageManager(new Driver());
            $imageFile = $request->file('profile_photo');

            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();

            // resize
            $resizedImage = $manager
                ->read($imageFile->getRealPath())
                ->resize(150, 150, function ($constraint) {
                    $constraint->aspectRatio();
                })->toJpeg(80);

            file_put_contents(public_path('/assets/uploads/thumbnail/hotels/' . $imageName), (string)$resizedImage);

            $imageFile->move(public_path('/assets/uploads/hotels'), $imageName);
        }

        hotels::create([
            'name' => $request->name,
            'email'=> $request->email,
            'address' => $request->address,
            'status' => $request->input('status'),
            'profile_photo' => $imageName
        ]);

        session()->flash('success','Your hotels has been insert successfully !');
        return redirect()->route('hotels.index');

    }

    public function destroy(string $myId){
        $hotel = hotels::find($myId);

        if ($hotel->profile_photo && file_exists(public_path('/assets/uploads/hotels/' . $hotel->profile_photo))) {
            unlink(public_path('/assets/uploads/hotels/' . $hotel->profile_photo));
        }

        // (optional) delete thumbnail too
        if ($hotel->profile_photo && file_exists(public_path('/assets/uploads/thumbnail/staff/' . $hotel->profile_photo))) {
            unlink(public_path('/assets/uploads/thumbnail/hotels/' . $hotel->profile_photo));
        }

        $hotel->delete();

        session()->flash('deleteSuccess','Your Data has been deleted !!');
        return redirect()->route('hotels.index');
    }

    public function show(string $myId){
        $myHotel = hotels::find($myId);
        $myHotelImages = HotelImage::where('hotel_id', $myId)->get();

        return view('BackEnd.Settings.Home-Hotel.view-hotels')
            ->with('myHotel',$myHotel)
            ->with('myHotelImages',$myHotelImages);
    }

    public function edit(string $id){
        $myHotel = hotels::find($id);

        return view('BackEnd.Settings.Home-Hotel.edit-hotels')->with('myHotel',$myHotel);
    }

    public function update(string $id, Request $request){
        
        $myHotel = hotels::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $myInput = $request->except('profile_photo');

        if ($request->hasFile('profile_photo')) {

            // ❗ Delete old image
            if ($myHotel->profile_photo && file_exists(public_path('/assets/uploads/hotels/' . $myHotel->profile_photo))) {
                unlink(public_path('/assets/uploads/hotels/' . $myHotel->profile_photo));
            }

            // Upload new image
            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('/assets/uploads/hotels'), $filename);

            $myInput['profile_photo'] = $filename;
        }

        // $myHotel::update($myInput);
        $myHotel->update($myInput);
        return redirect()->route('hotels.index')->with('updateSuccess', 'Data updated successfully!');
    }
    
}
