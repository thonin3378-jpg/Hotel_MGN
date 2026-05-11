<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\RoomTypes;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class roomTypeController extends Controller
{
   public function index(Request $request)
    {
        $search = $request->input('search');

        $myRoomType = RoomTypes::when($search, function($query, $search){
            return $query->where('name', 'like', "%{$search}%");
        })->paginate(7);

        $wifi = RoomTypes::where('wifi','1')->count();
        $active = RoomTypes::where('status','active')->count();
        $inactive = RoomTypes::where('status','inactive')->count();

        return view('BackEnd.Settings.Rooms-Type.index')
            ->with('wifi', $wifi)
            ->with('active', $active)
            ->with('inactive', $inactive)
            ->with('myRoomType', $myRoomType);
    }
    
    public function store(Request $request){
        // $input = $request->all();
        // dd($input);

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'bed' => 'required',
            'bath' => 'required',
            'wifi' => 'required',
            'status'=> 'required',
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

            file_put_contents(public_path('/assets/uploads/thumbnail/RoomsType/' . $imageName), (string)$resizedImage);

            $imageFile->move(public_path('/assets/uploads/RoomsType'), $imageName);
        }

        RoomTypes::create([
            'name' => $request -> name,
            'price' => $request -> price,
            'bed' => $request -> bed,
            'bath' => $request -> bath,
            'wifi' => $request -> wifi,
            'status' => $request -> status,
            'profile_photo' => $imageName
        ]);

        session()->flash('success','Your data has been insert success!');
        return redirect()->route("RoomTypes.index");

    }

    public function destroy(string $myId)
    {
        $myRoomType = RoomTypes::findOrFail($myId);

        if ($myRoomType->profile_photo && file_exists(public_path('/assets/uploads/RoomsType/' . $myRoomType->profile_photo))) {
            unlink(public_path('/assets/uploads/RoomsType/' . $myRoomType->profile_photo));
        }

        if ($myRoomType->profile_photo && file_exists(public_path('/assets/uploads/thumbnail/RoomsType/' . $myRoomType->profile_photo))) {
            unlink(public_path('/assets/uploads/thumbnail/RoomsType/' . $myRoomType->profile_photo));
        }
        $myRoomType->delete();

        return redirect()->route('RoomTypes.index')->with('deleteSuccess', 'Deleted successfully!');
    }
    
    public function edit(string $id){
        $myRoomType = RoomTypes::find($id);

        return view('BackEnd.Settings.Rooms-Type.edit-roomType')->with('myRoomType',$myRoomType);
    }

    public function update(Request $request, string $id){
        $mtRoomType = RoomTypes::find($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'bed' => 'required',
            'bath' => 'required',
            'wifi' => 'required',
            'status'=> 'required',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $myInput = $request->except('profile_photo');

        if ($request->hasFile('profile_photo')) {

            if ($mtRoomType->profile_photo && file_exists(public_path('/assets/uploads/RoomsType/' . $mtRoomType->profile_photo))) {
                unlink(public_path('/assets/uploads/RoomsType/' . $mtRoomType->profile_photo));
            }

            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('/assets/uploads/RoomsType'), $filename);

            $myInput['profile_photo'] = $filename;
        }

        $mtRoomType->update($myInput);

        return redirect()->route('RoomTypes.index')->with('updateSuccess', 'Data updated successfully!');
    }
}
