@extends('BackEnd.Layouts.master')
@section('contents')
@section('Setting-Privatecy','')
@section('Setting-Detail','')
@section('Hotels-Settings','active')
@section('Rooms','active')
@section('title','View Rooms')
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
                <h3>ROOM MORE DETAIL</h3>
              </div>
              <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a href="{{ route('dashboard.index') }}">Dashboard</a>
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
                      {{-- <div class="imageMy p-1" style="width:33.33%;">
                          @if($myRooms->profile_photo)
                              <img src="{{ asset('assets/uploads/Rooms/' . $myRooms->profile_photo) }}"
                                  class="w-100"
                                  style="height:200px; object-fit:cover; border-radius:8px;">
                          @else
                              <span>No Image</span>
                          @endif
                      </div> --}}

                      {{-- Images from hotel_images table --}}
                      @foreach ($myRoomImages as $value)
                          <div class="imageMy p-1" style="width:33.33%;">
                              @if($value->profile_photo)
                                  <img src="{{ asset('assets/uploads/Rooms/' . $value->profile_photo) }}"
                                      class="w-100"
                                      style="height:200px; object-fit:cover; border-radius:8px;">
                              @else
                                  <span>No Image</span>
                              @endif
                          </div>
                      @endforeach
                  </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <form action="#" method="get">
                      <div class="form-group">
                        <label for="name" class="form-label text-primary">Room Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $myRooms->name }}" readonly>
                      </div>
                      <div class="form-group">
                        <label for="name" class="form-label text-primary">Rooms Type</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $myRooms->roomType->name }}" readonly>
                      </div>
                      <div class="form-group">
                        <label for="name" class="form-label text-primary">Hotel Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $myRooms->hotel->name }}" readonly>
                      </div>
                      <div class="form-group">
                        <label for="email" class="form-label text-primary">Description</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Your Email" value="{{ $myRooms->detail }}" readonly>
                      </div>
                      <div class="form-group">
                        <label for="phone" class="form-label text-primary">Status</label>
                          @php
                            $myValue = ($myRooms->status == 'active') ? "Active" : "Inactive";
                          @endphp
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Your Phone" value=" {{ $myValue }} " readonly>
                      </div>
                      <div class="form-group">
                        <a href="{{ route('rooms.index') }}" type="submit" class="btn btn-primary">
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