<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\hotels;
use App\Models\Services;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use ResourceBundle;

class serviceBackendController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $myServices = Services::with('hotel')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                            ->orWhere('detail', 'like', "%{$search}%");
            })
            ->paginate(7);

        $myHotel = hotels::all();

        $activeCount = Services::where('status', 'active')->count();
        $inActiveCount = Services::where('status', 'inactive')->count();

        return view('BackEnd.Settings.Services.index', compact(
            'myServices',
            'myHotel',
            'activeCount',
            'inActiveCount'
        ));
    }

    public function store(Request $request){
        // $input = $request->all();
        // dd($input);

        $request->validate([
            'hotel_id' => 'required',
            'name' => 'required',
            'detail' => 'required',
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

            file_put_contents(public_path('/assets/uploads/thumbnail/servicesIMG/' . $imageName), (string)$resizedImage);

            $imageFile->move(public_path('/assets/uploads/servicesIMG'), $imageName);
        }

        Services::create([
            'hotel_id' => $request -> hotel_id,
            'name' => $request -> name,
            'detail' => $request -> detail,
            'status' => $request -> status,
            'profile_photo' => $imageName
        ]);

        session()->flash('success','Your data has benn inserted !! ');
        return redirect()->route('services.index');
    }
    
    public function show(string $getId){
        $myServices = Services::find($getId);

        return view('BackEnd.Settings.Services.view-service')
            ->with('myServices',$myServices);
    }
    public function destroy(string $id){

        $services = Services::find($id);

        if ($services->profile_photo && file_exists(public_path('/assets/uploads/servicesIMG/' . $services->profile_photo))) {
            unlink(public_path('/assets/uploads/servicesIMG/' . $services->profile_photo));
        }

        // (optional) delete thumbnail too
        if ($services->profile_photo && file_exists(public_path('/assets/uploads/thumbnail/servicesIMG/' . $services->profile_photo))) {
            unlink(public_path('/assets/uploads/thumbnail/servicesIMG/' . $services->profile_photo));
        }

        $services->delete();

        return redirect()->route('services.index')->with('deleteSuccess', 'Deleted successfully!');
    }

    public function edit(string $id){
        $myServices = Services::find($id);
        $myHotel = hotels::all();

        return view('BackEnd.Settings.Services.edit-service')
        ->with('myServices',$myServices)
        ->with('myHotel',$myHotel);
    }

    public function update(Request $request, string $id){
        $myServices = Services::find($id);

        $request->validate([
            'hotel_id' => 'required',
            'name' => 'required',
            'detail' => 'required',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $myInput = $request->except('profile_photo');

        if ($request->hasFile('profile_photo')) {

            //  Delete old image
            if ($myServices->profile_photo && file_exists(public_path('/assets/uploads/servicesIMG/' . $myServices->profile_photo))) {
                unlink(public_path('/assets/uploads/servicesIMG/' . $myServices->profile_photo));
            }

            // Upload new image
            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('/assets/uploads/servicesIMG'), $filename);

            $myInput['profile_photo'] = $filename;
        }

        $myServices->update($myInput);
        return redirect()->route('services.index')->with('updateSuccess', 'Data updated successfully!');
    }
}
