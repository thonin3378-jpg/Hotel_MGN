@extends('BackEnd.Layouts.master')
@section('contents')
@section('Setting-Privatecy','active')
@section('title','Users Setting')
@section('users','active')
@section('title','View Users')
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
                <h3>Account Profile</h3>
              </div>
              <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a href="{{ route('dashboard.index') }}">Dashboard</a>
                    </li>
                    <a href="{{ route('users.edit', $myUser->id) }}" class="breadcrumb-item active" aria-current="page">
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
                            @if($myStaff->profile_photo)
                                    <img src="{{ file_exists(public_path('assets/uploads/staff/' . $myStaff->profile_photo)) 
                                        ? asset('assets/uploads/staff/' . $myStaff->profile_photo) 
                                        : asset('uploads/staffs/' . $myStaff->profile_photo) }}"
                                        width="210" height="200" style="object-fit: cover; border-radius: 50%;">
                            @else
                                <span>No Image</span>
                            @endif
                      </div>

                      <h3 class="mt-3 text-primary"> {{ $myStaff->name }} </h3>
                      <p class="text-small">{{ $myStaff->email }}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-lg-8">
                <div class="card">
                  <div class="card-body mycard">
                    <form action="#" method="get">
                      <div class="form-group">
                        <label for="name" class="form-label text-primary">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" value="{{ $myStaff->name }}">
                      </div>
                      <div class="form-group">
                        <label for="name" class="form-label text-primary">Gender</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" value="{{ $myStaff->gender }}">
                      </div>
                      <div class="form-group">
                        <label for="email" class="form-label text-primary">Email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Your Email" value="{{ $myStaff->email }}">
                      </div>
                      <div class="form-group">
                        <label for="phone" class="form-label text-primary">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Your Phone" value="{{ $myStaff->phone }}">
                      </div>
                      <div class="form-group">
                        <label for="birthday" class="form-label text-primary">Address</label>
                        <input  name="birthday" id="birthday" class="form-control" value="{{ $myStaff->address }}">
                      </div>
                      <div class="form-group">
                        <label for="birthday" class="form-label text-primary">Postion</label>
                        <input  name="birthday" id="birthday" class="form-control" value="{{ $myStaff->position }}">
                      </div>
                      <div class="form-group">
                        <label for="birthday" class="form-label text-primary">Role</label>
                        <input  name="birthday" id="birthday" class="form-control" value="{{ $myUser->role }}">
                      </div>
                      <div class="form-group">
                        <a href="{{ route('users.index') }}" type="submit" class="btn btn-primary">
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