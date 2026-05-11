<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\HotelImage;
use App\Models\hotels;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class hotelImageController extends Controller
{

    public function index(Request $request){
        $myHotel = hotels::paginate(7);

        $hotelImages = HotelImage::with('hotel');

        if($request->hotel_id){
            $hotelImages->where('hotel_id', $request->hotel_id);
        }

        $hotelImage = $hotelImages->paginate(5);

        
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
        // $input = $request->all();
        // dd($input);

        $validate = $request->validate([
            'hotel_id'=>'required',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
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

        HotelImage::create([
            'hotel_id' => $request->hotel_id,
            'profile_photo' => $imageName
        ]);

        session()->flash('success','Your Image hotels has been insert successfully !');
        return redirect()->route('hotels.index');
    }

    public function destroy($id)
    {
        $myHotelImage = HotelImage::findOrFail($id);

        if ($myHotelImage->profile_photo && file_exists(public_path('/assets/uploads/hotels/' . $myHotelImage->profile_photo))) {
            unlink(public_path('/assets/uploads/hotels/' . $myHotelImage->profile_photo));
        }

        // (optional) delete thumbnail too
        if ($myHotelImage->profile_photo && file_exists(public_path('/assets/uploads/thumbnail/hotels/' . $myHotelImage->profile_photo))) {
            unlink(public_path('/assets/uploads/thumbnail/hotels/' . $myHotelImage->profile_photo));
        }
        $myHotelImage->delete();

        return redirect()->route('hotelImages.index')->with('deleteSuccess', 'Deleted successfully!');

       
    }
}
