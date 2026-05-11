@extends('BackEnd.Layouts.master')
@section('contents')
@section('Setting-Privatecy','')
@section('Setting-Detail','')
@section('Hotels-Settings','active')
@section('Rooms-Type','active')
@section('title','TypeRoom Setting')
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
                                    <h1 class="card-title text-light">UPDATE ROOM TYPE FORM</h1>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="{{ url('RoomTypes/'.$myRoomType->id) }}" method="POST" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Name</label>
                                                        <div class="position-relative">
                                                        <input type="text" class="form-control"
                                                            placeholder="Room Type Here"
                                                            id="first-name-icon" name="name" value="{{ $myRoomType->name }}">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-house"></i>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                        <label for="bed">Bed</label>
                                                        <div class="position-relative">
                                                        <input type="text" class="form-control"
                                                            placeholder="Number of Bed"
                                                            id="bed" name="bed" value="{{ $myRoomType->bed }}">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-house-door"></i>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                        <label for="Price">Price</label>
                                                        <div class="position-relative">
                                                        <input type="text" class="form-control"
                                                            placeholder="Price"
                                                            id="price" name="price" value="{{ $myRoomType->price }}">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-coin"></i>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                        <label for="Bath">Bath</label>
                                                        <div class="position-relative">
                                                        <input type="text" class="form-control"
                                                            placeholder="Number of Bath"
                                                            id="bath" name="bath" value="{{ $myRoomType->bath }}">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-moisture"></i>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                        <label for="Wifi">Wifi</label>
                                                        <div class="position-relative">
                                                        <select class="form-control" id="wifi" name="wifi">
                                                            <option value="1" {{ old('wifi',$myRoomType->wifi) == 1 ? 'selected' : '' }}>Yes</option>
                                                            <option value="0" {{ old('wifi',$myRoomType->wifi) == 0 ? 'selected' : '' }}>No</option>
                                                        </select>
                                                        <div class="form-control-icon">
                                                        <i class="bi bi-wifi"></i>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                        <label for="Status">Status</label>
                                                        <div class="position-relative">
                                                        <select class="form-control" id="status" name="status">
                                                            <option value="active" {{ old('status',$myRoomType->status) == 'active' ? 'selected' : ''}} >Active</option>
                                                            <option value="inactive" {{ old('status',$myRoomType->status) == 'inactive' ? 'selected' : ''}}>Inactive</option>
                                                        </select>
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-exclamation-circle"></i>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 mb-4">
                                                    {{-- 
                                                    <div class="form-group has-icon-left"> --}}
                                                        <label for="fileUpload">Upload File</label>
                                                        @if($myRoomType->profile_photo)
                                                            <img src="{{ asset('assets/uploads/RoomsType/'.$myRoomType->profile_photo) }}"
                                                                width="80" height="50"  class="mb-2" style="border-radius: 5px; object-fit: contain">
                                                        @endif
                                                        <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                                                        {{-- 
                                                    </div>
                                                    --}}
                                                </div>
                                                <div class="col-12 d-flex justify-content-end gap-2">
                                                    <a href="{{ route('RoomTypes.index') }}" class="btn btn-danger me-1 mb-1"><i class="bi bi-arrow-left-short me-1"></i>Back</a>
                                                    <button type="submit" class="btn btn-primary me-1 mb-1"><i class="bi bi-pencil-square me-1"></i>Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
            </div>
@endsection()