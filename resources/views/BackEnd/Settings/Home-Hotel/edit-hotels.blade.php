@extends('BackEnd.Layouts.master')
@section('contents')
@section('Setting-Privatecy','')
@section('Setting-Detail','')
@section('Hotels-Settings','active')
@section('Hotel','active')
@section('title','Update Hotels')
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
                                    <h1 class="card-title text-light">UPDATE HOTELS FORM</h1>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="{{ url('hotels/'.$myHotel->id) }}" method="POST" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Hotel Name</label>
                                                        <div class="position-relative">
                                                        <input type="text" class="form-control"
                                                            placeholder="Hotel Name here"
                                                            id="first-name-icon" name="name" value="{{ $myHotel->name }}">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-house"></i>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                        <label for="email">Email</label>
                                                        <div class="position-relative">
                                                        <input type="text" class="form-control"
                                                            placeholder="Email"
                                                            id="email" name="email" value="{{ $myHotel->email }}">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-envelope-at"></i>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                        <label for="Addrress">Addrress</label>
                                                        <div class="position-relative">
                                                        <select class="form-control" id="address" name="address">
                                                            <option value="" disabled>Choose Hotel Address</option>
                                                            <option value="PhnomPenh"
                                                                {{ old('address', $myHotel->address) == 'PhnomPenh' ? 'selected' : '' }}>Phnom Penh
                                                            </option>
                                                            <option value="SiemReab"
                                                                {{ old('address', $myHotel->address) == 'SiemReab' ? 'selected' : '' }}>Siem Reab
                                                            </option>
                                                            <option value="Kompot"
                                                                {{ old('address', $myHotel->address) == 'Kompot' ? 'selected' : '' }}>Kompot
                                                            </option>
                                                            <option value="Takav"
                                                                {{ old('address', $myHotel->address) == 'Takav' ? 'selected' : '' }}>Takav
                                                            </option>
                                                            <option value="KompongChnang"
                                                                {{ old('address', $myHotel->address) == 'KompongChnang' ? 'selected' : '' }}>Kompong Chnang
                                                            </option>
                                                        </select>
                                                        <div class="form-control-icon">
                                                        <i class="bi bi-geo-alt"></i>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                        <label for="Status">Status</label>
                                                        <div class="position-relative">
                                                        <select class="form-control" id="status" name="status">
                                                            <option value="1" {{ old('status',$myHotel->status) == 1 ? 'selected' : '' }} >Free</option>
                                                            <option value="0" {{ old('status',$myHotel->status) == 0 ? 'selected' : '' }} >Booking</option>
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
                                                        @if($myHotel->profile_photo)
                                                            <img src="{{ asset('assets/uploads/hotels/'.$myHotel->profile_photo) }}"
                                                                width="80" height="50"  class="mb-2" style="border-radius: 10px">
                                                        @endif
                                                        <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                                                        {{-- 
                                                    </div>
                                                    --}}
                                                </div>
                                                <div class="col-12 d-flex justify-content-end gap-2">
                                                    <a href="{{ route('hotels.index') }}" type="reset"
                                                        class="btn btn-danger me-1 mb-1"><i class="bi bi-arrow-left-short"></i> Back</a>
                                                    <button type="submit" class="btn btn-primary me-1 mb-1"><i class="bi bi-pencil-square"></i> Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
            </div>
@endsection()