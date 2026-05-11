<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\hotels;
use App\Models\RoomImage;
use App\Models\Rooms;
use App\Models\RoomTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Colors\Rgb\Channels\Red;

class RoomBackEndController extends Controller
{
    public function index(Request $request){
        
        $search = $request->input('search');

        $myRoom = Rooms::when($search, function($query, $search){
            return $query->where('name', 'like', "%{$search}%");
        })->paginate(7);

        $myHotel = hotels::all();
        $myRoomType = RoomTypes::all();
        $myRoomTypeTotal = Rooms::distinct('room_types_id')->count('room_types_id');
        $roomAll = Rooms::all();

        $active = Rooms::where('status','active')->count();
        $inactive = Rooms::where('status','inactive')->count();

        return view('BackEnd.Settings.Rooms.index')
            ->with('myHotel',$myHotel)
            ->with('myRoomType',$myRoomType)
            ->with('roomAll',$roomAll)
            ->with('myRoomTypeTotal',$myRoomTypeTotal)
            ->with('active',$active)
            ->with('inactive',$inactive)
            ->with('myRoom',$myRoom);
    }

    public function store(Request $request){
        // $input = $request->all();
        // dd($input);

        $request->validate([
            'hotel_id' => 'required',
            'room_types_id' => 'required',
            'name' => 'required',
            'status' => 'required',
            'detail' => 'required' 
        ]);

        Rooms::create([
            'hotel_id' => $request -> hotel_id,
            'room_types_id' => $request -> room_types_id,
            'name' => $request  -> name,
            'status' => $request -> status,
            'detail' => $request -> detail
        ]);

        session()->flash('success','Your data has been inserted');
        return redirect()->route('rooms.index');
    }

    public function show(string $id){
        $myRooms = Rooms::find($id);
        $myRoomImages = RoomImage::where('room_id',$id)->get();

        // $myHotelImages = HotelImage::where('hotel_id', $myId)->get();

        return view('BackEnd.Settings.Rooms.view-rooms')
            ->with('myRooms',$myRooms)
            ->with('myRoomImages',$myRoomImages);

    }

    public function destroy(string $id){
        $deleteRooms = Rooms::find($id);

        $deleteRooms->delete();

        session()->flash('success','Your data has been Delete');
        return redirect()->route('rooms.index');
    }

    public function edit(string $id){
        $myRooms = Rooms::find($id);
        $myHotel = hotels::all();
        $myRoomType = RoomTypes::all();

        return view('BackEnd.Settings.Rooms.edit-room')
            ->with('myRooms',$myRooms)
            ->with('myHotel',$myHotel)
            ->with('myRoomType',$myRoomType);
    }

    public function update(Request $request, string $id){
        $myRoom = Rooms::find($id);

        $request->validate([
            'hotel_id' => 'required',
            'room_types_id' => 'required',
            'name' => 'required',
            'status' => 'required',
            'detail' => 'required' 
        ]);

        $myRoom->update([
            'hotel_id' => $request->hotel_id,
            'room_types_id' => $request->room_types_id,
            'name' => $request->name,
            'status' => $request->status,
            'detail' => $request->detail,
        ]);
 
        
        session()->flash('success','Your data has been updated !');
        return redirect()->route('rooms.index');
    }

}
