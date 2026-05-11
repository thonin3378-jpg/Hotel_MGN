@extends('BackEnd.Layouts.master')
@section('contents')
@section('Hotels-Settings','active')
@section('Setting-Detail','dd')
@section('title','Service Setting')
@section('services','active')
@section('title','Update Services')
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
                                    <h1 class="card-title text-light">UPDATE SERVICE FORM</h1>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="{{ url('services/'.$myServices->id) }}" method="POST" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                        <label for="hotel">Choose Hotel</label>
                                                        <div class="position-relative">
                                                        <select class="form-control" id="hotel_id" name="hotel_id" value="old('hotel_id')">
                                                            <option value="">Choose Hotel</option>
                                                            @foreach ($myHotel as $value)
                                                            <option value="{{ $value->id }}"
                                                                {{ old('hotel_id', $myServices->hotel_id) == $value->id ? 'selected' : '' }}>
                                                                {{ $value->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-house-heart-fill"></i>
                                                        </div>
                                                        </div>
                                                        @error('hotel_id')
                                                        <p class="text-danger mt-1" > {{ $message }} </p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Name</label>
                                                        <div class="position-relative">
                                                        <input type="text" class="form-control" placeholder="Services Name here" id="name" name="name" value="{{ old('name', $myServices->name) }}">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-gear-fill"></i>
                                                        </div>
                                                        </div>
                                                        @error('name')
                                                        <p class="text-danger mt-1" > {{ $message }} </p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                        <label for="detail">Detail</label>
                                                        <div class="position-relative">
                                                        <input type="text" class="form-control" placeholder="Detail here" id="detail" name="detail" value="{{ old('detail', $myServices->detail) }}">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-ticket-detailed"></i>
                                                        </div>
                                                        </div>
                                                        @error('detail')
                                                        <p class="text-danger mt-1" > {{ $message }} </p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                        <label for="status">Status</label>
                                                        <div class="position-relative">
                                                        <select class="form-control" id="status" name="status">
                                                        <option value="active"
                                                            {{ old('status', $myServices->status) == 'active' ? 'selected' : '' }}>
                                                            Active
                                                        </option>

                                                        <option value="inactive"
                                                            {{ old('status', $myServices->status) == 'inactive' ? 'selected' : '' }}>
                                                            Inactive
                                                        </option>
                                                        </select>
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-border-width"></i>
                                                        </div>
                                                        </div>
                                                        @error('status')
                                                        <p class="text-danger mt-1" > {{ $message }} </p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 mb-4">
                                                    {{-- 
                                                    <div class="form-group has-icon-left"> --}}
                                                        <label for="fileUpload" name="file Progile">Upload File</label>
                                                        @if($myServices->profile_photo)
                                                            <div class="mb-2">
                                                                <img src="{{ asset('assets/uploads/servicesIMG/'.$myServices->profile_photo) }}"
                                                                    width="80">
                                                            </div>
                                                        @endif
                                                        <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                                                        {{-- 
                                                    </div>
                                                    --}}
                                                    @error('profile_photo')
                                                    <p class="text-danger mt-1" > {{ $message }} </p>
                                                    @enderror
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <a href="{{ route('services.index') }}" type="reset" class="btn btn-danger me-2 mb-1 pe-4 ps-4"><i class="bi bi-arrow-left-circle-fill me-1"></i> Back</a>
                                                    <button type="submit"class="btn btn-primary me-3 mb-1 pe-4 ps-4"><i class="bi bi-pencil-square"></i> Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
            </div>
@endsection()