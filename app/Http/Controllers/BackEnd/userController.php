<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\MyUsers;
use App\Models\staffs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use SoapFault;

class userController extends Controller
{
    public function index(Request $request){

        $myStaff = staffs::all();

        $search = $request->input('search');
        $myUsers = MyUsers::with('staff')->when($search, function($query, $search){
            $query->whereHas('staff', function($q) use ($search){
                $q->where('name', 'like', "%{$search}%");
            });
        })
        ->paginate(7);

        $maleCount = staffs::where('gender','Male')->count();
        $femaleCount = staffs::where('gender','Female')->count();
        $myrole = MyUsers::where('role','Manager')->count();

        return view('BackEnd.Settings.Users.index')
            ->with('maleCount',$maleCount)
            ->with('femaleCount',$femaleCount)
            ->with('myrole',$myrole)
            ->with('myStaff',$myStaff)
            ->with('myUsers',$myUsers);
    }
    public function create(){
        $mystaff = staffs::all();
        return view('BackEnd.Settings.Users.add-user')->with('mystaff',$mystaff);
    }
    // public function create(){
    //     $mystaff = staffs::all();
    //     return view('BackEnd.Settings.Users.add-user')->with('mystaff',$mystaff);
    // }
    public function store(Request $request){
        // $myinput = $request->all();
        // dd($myinput);
        $request->validate([
            'staff_id' => 'required',
            'password' => 'required',
            'role'=> 'required'
        ]);
        MyUsers::create([
            'staff_id' => $request->staff_id,
            'password' => Hash::make($request->password),
            'role'=> $request->role
        ]);
        session()->flash('success','Data insert successfully');
        return redirect()->route('users.index');
    }
    public function edit(string $myId){
        $myUser = MyUsers::find($myId);
        $myStaff = staffs::all();

        return view('BackEnd.Settings.Users.edit-user')
            ->with('myUser',$myUser)
            ->with('myStaff',$myStaff);
    }
    public function update(Request $request, string $myId){
        $myUser = MyUsers::find($myId);

        $request->validate([
            // 'staff_id' => 'required',
            'password' => 'required',
            'role'=> 'required'
        ]);

        $myUser->update($request->all());

        session()->flash('updateSuccess','Data Update successfully');
        return redirect()->route('users.index');
    }
    public function destroy(string $myId){
        $myUser = MyUsers::findOrFail($myId);
        $myUser->delete();


        return redirect()->route('users.index')->with('deleteSuccess', 'Deleted successfully!');
    }

    public function show(string $myId){

        $myUser = MyUsers::find($myId);
        $myStaff = staffs::find($myUser->staff_id);
       

        return view('BackEnd.Settings.Users.view')
            ->with('myUser',$myUser)
            ->with('myStaff',$myStaff);
    }
}
