<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\hotels;
use App\Models\staffs;
use Illuminate\Http\Request;
use Intervention\Image\Colors\Rgb\Channels\Red;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Drivers\Imagick\Driver as ImagickDriver;
use Intervention\Image\ImageManager;
use Symfony\Component\Console\Input\Input;

class staffsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $myStaff = staffs::when($search, function($query, $search){
            return $query->where('name','like', "%{$search}%");
        })->paginate(7);

        $hotelData  = hotels::all();

        $adminCount = staffs::where('position', 'Admin')->count();
        $maleCount = staffs::where('gender', 'Male')->count();
        $femaleCount = staffs::where('gender', 'Female')->count();

        return view("BackEnd.Settings.Stuffs.index")
            ->with('myStaff', $myStaff)
            ->with('adminCount', $adminCount)
            ->with('hotelData', $hotelData)
            ->with('maleCount', $maleCount)
            ->with('femaleCount', $femaleCount);
    }
    public function create(){
        $hotelData = hotels::all();
        return view('BackEnd.Settings.Stuffs.add-stuff')->with('hotelData', $hotelData);
    }

    public function store(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required',
            'phone' => 'required',
            'name' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'email' => 'required',
            'position' => 'required',
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

            file_put_contents(public_path('/assets/uploads/thumbnail/staff/' . $imageName), (string)$resizedImage);

            $imageFile->move(public_path('/assets/uploads/staff'), $imageName);
        }

        // Save data to DB
        staffs::create([
            'hotel_id' => $request->hotel_id,
            'name' => $request->name,
            'gender' => $request->gender,
            'position' => $request->position,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'profile_photo' => $imageName
        ]);

        session()->flash('success', 'Your Data has been inserted!');
        return redirect()->route('staffs.index');
    }
    public function edit(string $myId){
        $staff = staffs::findOrFail($myId);
        $hotelData = hotels::all();
        return view('BackEnd.Settings.Stuffs.edit-stuff')
                    ->with('staff',$staff)
                    ->with('hotelData',$hotelData);
    }
    public function update(Request $request, string $myId){
        $staff = staffs::findOrFail($myId);

        $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'gender' => 'required|in:Male,Female',
            'email' => 'required|email|max:255',
            'position' => 'required|string',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $myInput = $request->except('profile_photo');

        if ($request->hasFile('profile_photo')) {

            // ❗ Delete old image
            if ($staff->profile_photo && file_exists(public_path('/assets/uploads/staff/' . $staff->profile_photo))) {
                unlink(public_path('/assets/uploads/staff/' . $staff->profile_photo));
            }

            // Upload new image
            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('/assets/uploads/staff'), $filename);

            $myInput['profile_photo'] = $filename;
        }

        $staff->update($myInput);

        return redirect()->route('staffs.index')->with('updateSuccess', 'Data updated successfully!');
    }
    public function destroy(string $myId)
    {
        $staff = staffs::findOrFail($myId);

        
        if ($staff->profile_photo && file_exists(public_path('/assets/uploads/staff/' . $staff->profile_photo))) {
            unlink(public_path('/assets/uploads/staff/' . $staff->profile_photo));
        }

        // (optional) delete thumbnail too
        if ($staff->profile_photo && file_exists(public_path('/assets/uploads/thumbnail/staff/' . $staff->profile_photo))) {
            unlink(public_path('/assets/uploads/thumbnail/staff/' . $staff->profile_photo));
        }
        $staff->delete();

        return redirect()->route('staffs.index')->with('deleteSuccess', 'Deleted successfully!');
    }
    public function show(string $myId){
        $myStaff = staffs::find($myId);
        return view('BackEnd.Settings.Stuffs.view-stuff')->with('myStaff',$myStaff);
    }
}
