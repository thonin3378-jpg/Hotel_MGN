@extends('BackEnd.Layouts.master')
@section('contents')
@section('title','Update Customer')
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
                                    <h1 class="card-title text-light">UPDATE CUSTOMERS FORM</h1>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="{{ url('customers/'.$myCustomer->id) }}" method="POST" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 col-12 mb-2"> 
                                                    <div class="form-group has-icon-left">
                                                            <label for="first-name-icon" class="text-primary">Name</label>
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control" placeholder="Stuff Name here" id="name" name="name" value="{{ $myCustomer->name }}">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-person"></i>
                                                                </div>
                                                            </div>
                                                            @error('name')
                                                                <p class="text-danger mt-1" > {{ $message }} </p>
                                                            @enderror
                                                    </div>
                                                </div>
                                                 <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                            <label for="email" class="text-primary">Email</label>
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control"
                                                                    placeholder="Email"
                                                                    id="email" name="email" value="{{ $myCustomer->email }}">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-envelope-at"></i>
                                                                </div>
                                                            </div>
                                                            @error('email')
                                                                <p class="text-danger mt-1" > {{ $message }} </p>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                            <label for="gender" class="text-primary">Gender</label>
                                                            <div class="position-relative">
                                                                <select class="form-control" id="gender" name="gender">
                                                                    <option value="Male" {{ ($myCustomer->gender) == 'Male' ? 'selected' : ''}} >Male</option>
                                                                    <option value="Female"{{ ($myCustomer->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                                                </select>
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-gender-ambiguous"></i>
                                                                </div>
                                                            </div>
                                                            @error('gender')
                                                                <p class="text-danger mt-1" > {{ $message }} </p>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                            <label for="phone" class="text-primary">Phone</label>
                                                            <div class="position-relative"> 
                                                                <input type="text" class="form-control"placeholder="Phone number"id="phone" name="phone" value="{{ $myCustomer->phone }}" >
                                                                <div class="form-control-icon"><i class="bi bi-telephone"></i></div>
                                                            </div>
                                                            @error('phone')
                                                                <p class="text-danger mt-1" > {{ $message }} </p>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                            <label for="password">Password</label>
                                                            <div class="position-relative"> 
                                                                <input type="password" class="form-control" name="password" placeholder="Leave blank to keep old password">
                                                                {{-- <input type="password" class="form-control" placeholder="password"id="password" name="password" value="{{ $myCustomer->password }}" > --}}
                                                                <div class="form-control-icon"><i class="bi bi-telephone"></i></div>
                                                            </div>
                                                            @error('password')
                                                                <p class="text-danger mt-1" > {{ $message }} </p>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 mb-4">
                                                    {{-- <div class="form-group has-icon-left"> --}}
                                                            <label for="fileUpload" name="file Progile" class="text-primary">Upload File</label>
                                                            <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                                                    {{-- </div> --}}
                                                            @error('profile_photo')
                                                                <p class="text-danger mt-1" > {{ $message }} </p>
                                                            @enderror
                                                </div>
                                                
                                                <div class="col-12 d-flex justify-content-end">
                                                    <a href="{{ route('customers.index') }}" type="reset" class="btn btn-danger me-2 mb-1 pe-4 ps-4"><i class="bi bi-arrow-left-circle-fill me-1"></i> Back</a>
                                                    <button type="submit"class="btn btn-primary me-3 mb-1 pe-4 ps-4"><i class="bi bi-floppy2 me-1"></i> Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
            </div>
@endsection()