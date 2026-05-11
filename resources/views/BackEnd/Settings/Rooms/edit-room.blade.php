@extends('BackEnd.Layouts.master')
@section('contents')
@section('Setting-Privatecy','')
@section('Setting-Detail','')
@section('Hotels-Settings','active')
@section('Rooms','active')
@section('title','Hotels Setting')
<style>
    .bigg-main{
        background-color: #00000014;
    }
</style>
    <div id="main"  class="bigg-main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            {{-- ==================[ Start Contents ]================== --}}
            <div class="page-heading ">
                <h3>Hotel-Resturant Dashboard</h3>
            </div>
            <div class="page-content">
                <div class="card" data-aos="fade-up">
                                <div class="card-header text-center bg-primary">
                                    <h1 class="card-title text-light">UPDATE ROOMS FORM</h1>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="{{ url('rooms/'.$myRooms->id) }}" method="POST" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                        <label for="hotel_id">Choose Hotel</label>
                                                        <div class="position-relative">
                                                        <select class="form-control" id="hotel_id" name="hotel_id">
                                                            <option value="" disabled selected>Choose Hotel</option>
                                                            @foreach ($myHotel as $value)  
                                                                <option value="{{ $value->id }}" {{ old('hotel_id', $myRooms->hotel_id) == $value->id ? 'selected' : '' }}>{{ $value->name }} </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="form-control-icon">
                                                        <i class="bi bi-door-open"></i>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                        <label for="room_types_id">Choose Rooms Type</label>
                                                        <div class="position-relative">
                                                        <select class="form-control" id="room_types_id" name="room_types_id">
                                                            <option value="" disabled selected>Choose Rooom Type</option>
                                                            @foreach ($myRoomType as $key => $value )  
                                                            <option value="{{ $value->id }}" {{ old('room_types_id',$myRooms->room_types_id) == $value->id ? 'selected' : '' }} > {{ $value->name }} </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="form-control-icon">
                                                        <i class="bi bi-houses-fill"></i>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Name</label>
                                                        <div class="position-relative">
                                                        <input type="text" class="form-control"
                                                            placeholder="Room Name here"
                                                            id="first-name-icon" name="name" value="{{ $myRooms->name }}">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-house"></i>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Description</label>
                                                        <div class="position-relative">
                                                        <input type="text" class="form-control"
                                                            placeholder="Descript The Rooms"
                                                            id="first-name-icon" name="detail" value="{{ $myRooms->detail }}">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-ticket-detailed"></i>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                        <label for="Status">Status</label>
                                                        <div class="position-relative">
                                                        <select class="form-control" id="status" name="status">
                                                            <option value="active" {{ old('status', $myRooms->status) == 'active' ? 'selected' : '' }} >Active</option>
                                                            <option value="inactive" {{ old('status', $myRooms->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                        </select>
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-radioactive"></i>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-md-12 col-12 mb-4">
                                                    
                                                        <label for="fileUpload">Upload File</label>
                                                        <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                                                    
                                                </div> --}}
                                                <div class="col-12 d-flex justify-content-end gap-2">
                                                    <a href="{{ route('rooms.index') }}" type="reset"
                                                        class="btn btn-danger me-1 mb-1">Back</a>
                                                    <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
            </div>
@endsection()