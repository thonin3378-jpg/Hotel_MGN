@extends('BackEnd.Layouts.master')
@section('contents')
@section('Hotels-Settings','active')
@section('Setting-Detail','dd')
@section('title','Service Setting')
@section('services','active')
@section('title','View Services')
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
                <h3>Services Profile</h3>
              </div>
              <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a href="{{ route('dashboard.index') }}">Dashboard</a>
                    </li>
                    <a href="{{ route('services.edit', $myServices->id) }}" class="breadcrumb-item active" aria-current="page">
                      Go Update
                    </a>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
          <section class="section">
            <div class="row">
              <div class="col-12 col-lg-4">
                <div class="card">
                  <div class="card-body mycard">
                    <div class="d-flex justify-content-center align-items-center flex-column">
                      <div class="imageMy">
                            @if($myServices->profile_photo)
                                    <img src="{{ file_exists(public_path('assets/uploads/servicesIMG/' . $myServices->profile_photo)) 
                                        ? asset('assets/uploads/servicesIMG/' . $myServices->profile_photo) 
                                        : asset('uploads/servicesIMG/' . $myServices->profile_photo) }}"
                                        width="210" height="200" style="object-fit: cover; border-radius: 5%;">
                            @else
                                <span class="bg-danger p-3 text-light">No Image here !!! </span>
                            @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-lg-8">
                <div class="card">
                  <div class="card-body mycard">
                    <form action="#" method="get">
                      <div class="form-group">
                        <label for="name" class="form-label text-primary">Service Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" value="{{ $myServices->name }}" readonly>
                      </div>
                      <div class="form-group">
                        <label for="name" class="form-label text-primary">Hotel Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" value="{{ $myServices->hotel->name }}" readonly>
                      </div>
                      <div class="form-group">
                        <label for="birthday" class="form-label text-primary">Detail</label>
                        <input  name="birthday" id="birthday" class="form-control" value="{{ $myServices->detail }}" readonly>
                      </div>
                      <div class="form-group">
                        <label for="birthday" class="form-label text-primary">Status</label>
                          @php
                            $myValue = ($myServices->status == "active") ? "Active" : "Inactive";
                          @endphp
                        <input  name="birthday" id="birthday" class="form-control" value="{{ $myValue }}" readonly>
                      </div>
                      <div class="form-group mt-4">
                        <a href="{{ route('services.index') }}" type="submit" class="btn btn-primary">
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