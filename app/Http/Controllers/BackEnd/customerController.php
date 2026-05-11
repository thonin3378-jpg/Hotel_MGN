<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use Illuminate\Http\Request;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Drivers\Imagick\Driver as ImagickDriver;
use Intervention\Image\ImageManager;

class customerController extends Controller
{
    public function index(Request $request){

        $search = $request->input('search');

        $myCustomer = Customers::when($search, function($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->paginate(7);
        
        $maleCount = Customers::where('gender', 'Male')->count();
        $femaleCount = Customers::where('gender', 'Female')->count();

        return view('BackEnd.Settings.Customers.index')
            ->with('myCustomer', $myCustomer)
            ->with('maleCount', $maleCount)
            ->with('femaleCount', $femaleCount);
    }
    public function create(){
        return view('BackEnd.Settings.Customers.add-customer');
    }

    public function show(string $myId){
        $myCustomer = Customers::find($myId);
        return view('BackEnd.Settings.Customers.view-customer')->with('myCustomer',$myCustomer);
    }

    public function store(Request $request){
        // $input = $request->all();
        // dd($input);

        $request -> validate([
            'name' => 'required',
            'gender' => 'nullable',
            'phone' => 'nullable',
            'email' => 'required',
            'password' => 'required',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $imageName = null;

        if ($request->hasFile('profile_photo')) {
            $manager = new ImageManager(new Driver());
            $imageFile = $request->file('profile_photo');

            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();

            // resizewe
            $resizedImage = $manager
                ->read($imageFile->getRealPath())
                ->resize(150, 150, function ($constraint) {
                    $constraint->aspectRatio();
                })->toJpeg(80);

            file_put_contents(public_path('/assets/uploads/thumbnail/customers/' . $imageName), (string)$resizedImage);

            $imageFile->move(public_path('/assets/uploads/customers'), $imageName);
        }

        Customers::create([
            'name' => $request -> name,
            'gender' => $request -> gender,
            'email' => $request -> email,
            'phone' => $request -> phone,
            'password' => $request -> password,
            'profile_photo' => $imageName
        ]);

        session()->flash('success','Dada insert successfully !! ');
        return redirect()->route('customers.index');
    }

    public function edit(string $myId){
        $myCustomer = Customers::find($myId);
        return view('BackEnd.Settings.Customers.edit-customer')->with('myCustomer',$myCustomer);
    }
    public function update(string $myId, Request $request){
        $myCustomer = Customers::find($myId);

        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'password' => 'nullable',
            'profile_photo' => 'nullable|image'
        ]);

        $myInput = $request->except('profile_photo', 'password');

        
        if ($request->filled('password')) {
            // $myInput['password'] = bcrypt($request->password);
            $myInput['password'] = $request->password;
        }

        // image
        if ($request->hasFile('profile_photo')) {

            if ($myCustomer->profile_photo && file_exists(public_path('/assets/uploads/customers/' . $myCustomer->profile_photo))) {
                unlink(public_path('/assets/uploads/customers/' . $myCustomer->profile_photo));
            }

            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('/assets/uploads/customers'), $filename);

            $myInput['profile_photo'] = $filename;
        }

        $myCustomer->update($myInput);

        return redirect()->route('customers.index');
    }
    function destroy(string $myId){
        
         $myCustomer = Customers::find($myId); 

        
        if ($myCustomer->profile_photo && file_exists(public_path('/assets/uploads/customers/' . $myCustomer->profile_photo))) {
            unlink(public_path('/assets/uploads/customers/' . $myCustomer->profile_photo));
        }

        // (optional) delete thumbnail too
        if ($myCustomer->profile_photo && file_exists(public_path('/assets/uploads/thumbnail/customers/' . $myCustomer->profile_photo))) {
            unlink(public_path('/assets/uploads/thumbnail/customers/' . $myCustomer->profile_photo));
        }
        $myCustomer->delete();

        return redirect()->route('customers.index')->with('deleteSuccess', 'Deleted successfully!');
    }
}
