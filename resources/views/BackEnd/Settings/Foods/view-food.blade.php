@extends('BackEnd.Layouts.master')
@section('contents')
@section('Setting-Privatecy','')
@section('Setting-Detail','')
@section('Foods-Settings','active')
@section('Foods','active')
@section('title','Foods Setting')
    <div id="main" class="main-veiw">
        <header class="mb-3">
          <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
          </a>
        </header>

        <div class="page-heading">
          <div class="page-title">
            <div class="row">
              <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>FOODS MORE DETAIL</h3>
              </div>
              <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a href="{{ route('dashboard.index') }}">DARSHBOARD</a>
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
          <section class="section">
            <div class="row">
              <div class="col-12 col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <p>Photo Album</p>
                    <div class="d-flex flex-wrap">
                      <div class="imageMy p-1" style="width:33.33%;">
                          @if($myFoods->profile_photo)
                              <img src="{{ asset('assets/uploads/Foods/' . $myFoods->profile_photo) }}"
                                  class="w-100"
                                  style="height:200px; object-fit:cover; border-radius:8px;">
                          @else
                              <span>No Image</span>
                          @endif
                      </div>

                      {{-- Images from hotel_images table --}}
                      {{-- @foreach ($myHotelImages as $value)
                          <div class="imageMy p-1" style="width:33.33%;">
                              @if($value->profile_photo)
                                  <img src="{{ asset('assets/uploads/Foods/' . $value->profile_photo) }}"
                                      class="w-100"
                                      style="height:200px; object-fit:cover; border-radius:8px;">
                              @else
                                  <span>No Image</span>
                              @endif
                          </div>
                      @endforeach --}}
                  </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <form action="#" method="get">
                      <div class="form-group">
                        <label for="name" class="form-label text-primary">Food Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $myFoods->name }}" readonly="readonly">
                      </div>
                      <div class="form-group">
                        <label for="name" class="form-label text-primary">Hotel Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $myFoods->hotel->name }}" readonly="readonly">
                      </div>
                      <div class="form-group">
                        <label for="name" class="form-label text-primary">Food Category Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $myFoods->foodCategory->name }}" readonly="readonly">
                      </div>
                      <div class="form-group">
                        <label for="name" class="form-label text-primary">Food Price</label>
                        <input type="text" name="name" id="name" class="form-control" value="$ {{ $myFoods->price }}" readonly="readonly">
                      </div>
                      <div class="form-group">
                        <label for="name" class="form-label text-primary">Discount</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ number_format($myFoods->discount, 0) }} %" readonly="readonly">
                      </div>
                      <div class="form-group">
                        <label for="name" class="form-label text-primary">Description</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $myFoods->description }}" readonly="readonly">
                      </div>
                      
                     
                      <div class="form-group">
                        <label for="phone" class="form-label text-primary">Status</label>
                          @php
                            $myValue = ($myFoods->status == 'available') ? "Available" : "Inavailable";
                          @endphp
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Your Phone" value=" {{ $myValue }} " readonly="readonly">
                      </div>
                      <div class="form-group">
                        <a href="{{ route('foods.index') }}" type="submit" class="btn btn-primary">
                          Go Back
                        </a>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
      <style>
        .card-body{
            border-radius: 10px;
            box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px, rgba(0, 0, 0, 0.05) 0px 5px 10px;
        }
        
    </style>
@endsection()