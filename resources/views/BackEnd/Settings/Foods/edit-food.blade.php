@extends('BackEnd.Layouts.master')
@section('contents')
@section('Setting-Privatecy','')
@section('Setting-Detail','')
@section('Foods-Settings','active')
@section('Foods','active')
@section('title','Foods Update')
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
                <h3>HOTEL AND RESTURAND DARSHBOARD</h3>
            </div>
            <div class="page-content">
                <div class="card" data-aos="fade-up">
                                <div class="card-header text-center bg-primary">
                                    <h1 class="card-title text-light">UPDATE FOODS FORM</h1>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="{{ url('foods/'.$myFood->id) }}" method="POST" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                        <label for="hotel_id">Choose Hotel</label>
                                                        <div class="position-relative">
                                                        <select class="form-control" id="hotel_id" name="hotel_id">
                                                            <option value="" disabled selected>Choose Hotel</option>
                                                            @foreach ($myHotel as $key => $value )  
                                                            <option value="{{ $value->id }}" {{ old('hotel_id',$myFood->hotel_id) == $value->id ? 'selected' : '' }} > {{ $value->name }} </option>
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
                                                        <label for="category_id">Choose Categoty Type</label>
                                                        <div class="position-relative">
                                                        <select class="form-control" id="category_id" name="category_id">
                                                            <option value="" disabled selected>Choose Categoty Type</option>
                                                            @foreach ($myCagegory as $key => $value )  
                                                            <option value="{{ $value->id }}" {{ old('category_id',$myFood->category_id) == $value->id ? 'selected' : '' }} > {{ $value->name }} </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="form-control-icon">
                                                        <i class="bi bi-code-square"></i>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Name</label>
                                                        <div class="position-relative">
                                                        <input type="text" class="form-control"
                                                            placeholder="Food Name here"
                                                            id="first-name-icon" name="name" value="{{ $myFood->name }}">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-egg-fill"></i>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                        <label for="Status">Discount</label>
                                                        <div class="position-relative">
                                                        <select class="form-control" id="discount" name="discount">
                                                            <option value="10" {{ old('discount',$myFood->discount) == 10 ? 'selected' : '' }} >Discount 10%</option>
                                                            <option value="20" {{ old('discount',$myFood->discount) == 20 ? 'selected' : '' }}>Discount 20%</option>
                                                            <option value="30" {{ old('discount',$myFood->discount) == 30 ? 'selected' : '' }}>Discount 30%</option>
                                                            <option value="50" {{ old('discount',$myFood->discount) == 50 ? 'selected' : '' }}>Discount 50%</option>
                                                        </select>
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-tags"></i>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Price</label>
                                                        <div class="position-relative">
                                                        <input type="text" class="form-control"
                                                            placeholder="Descript The Rooms"
                                                            id="first-name-icon" name="price" value="{{ $myFood->price }}">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-award"></i>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                        <label for="Status">Status</label>
                                                        <div class="position-relative">
                                                        <select class="form-control" id="status" name="status">
                                                            <option value="available" {{ old('status',$myFood->status) == 'available' ? 'selected' : '' }} >Available</option>
                                                            <option value="inavailable" {{ old('status',$myFood->status) == 'inavailable' ? 'selected' : '' }} >Inavailable</option>
                                                        </select>
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-radioactive"></i>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Description</label>
                                                        <div class="position-relative">
                                                        <input type="text" class="form-control"
                                                            placeholder="Descript The foods"
                                                            id="first-name-icon" name="description" value="{{ $myFood->description }}">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-amd"></i>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 mb-4">
                                                    <label for="fileUpload">Upload File</label>
                                                    @if($myFood->profile_photo)
                                                        <img src="{{ asset('assets/uploads/Foods/'.$myFood->profile_photo) }}"
                                                        width="80" height="50"  class="mb-2" style="border-radius: 5px">
                                                    @endif
                                                    <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                                                </div>
                                                <div class="col-12 d-flex justify-content-end gap-2">
                                                    <a href="{{ route('foods.index') }}" type="reset"
                                                        class="btn btn-danger me-1 mb-1"><i class="bi bi-arrow-left-short me-1"></i>Back</a>
                                                    <button type="submit" class="btn btn-primary me-1 mb-1"><i class="bi bi-bookmark-heart me-1"></i>Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
            </div>
@endsection()