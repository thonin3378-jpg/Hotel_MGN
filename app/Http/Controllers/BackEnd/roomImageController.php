<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\RoomImage;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class roomImageController extends Controller
{
    // public function index(){
    //     return view('BackEnd.Settings.Rooms.index');
    // }
    // public function store(Request $request){
    //     // $input = $request->all();
    //     // dd($input);

    //     $request->validate([
    //         'room_id' => 'required',
    //         'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
    //     ]);

    //     $imageName = null;

    //     if ($request->hasFile('profile_photo')) {
    //         $manager = new ImageManager(new Driver());
    //         $imageFile = $request->file('profile_photo');

    //         $imageName = time() . '.' . $imageFile->getClientOriginalExtension();

    //         // resize
    //         $resizedImage = $manager
    //             ->read($imageFile->getRealPath())
    //             ->resize(150, 150, function ($constraint) {
    //                 $constraint->aspectRatio();
    //             })->toJpeg(80);

    //         file_put_contents(public_path('/assets/uploads/thumbnail/Rooms/' . $imageName), (string)$resizedImage);

    //         $imageFile->move(public_path('/assets/uploads/Rooms'), $imageName);
    //     }

    //     RoomImage::create([
    //         'room_id' => $request -> room_id,
    //         'profile_photo' => $imageName
    //     ]);

    //     session()->flash('success','Your Images has been inserted !');
    //     return redirect()->route('rooms.index');
    // }
    public function store(Request $request){
    
        $request->validate([
            'room_id' => 'required',
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
                public_path('/assets/uploads/thumbnail/Rooms/' . $imageName),
                (string)$resizedImage
            );
            $imageFile->move(public_path('/assets/uploads/Rooms'), $imageName);
        }

        RoomImage::create([
            'room_id' => $request->room_id,
            'profile_photo' => $imageName
        ]);

        session()->flash('success','Your Images has been inserted !');
        return redirect()->route('rooms.index');
    }
}
