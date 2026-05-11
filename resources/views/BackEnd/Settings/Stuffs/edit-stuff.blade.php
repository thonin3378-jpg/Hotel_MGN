@extends('BackEnd.Layouts.master')
@section('contents')
@section('title','Update Staff')
{{-- @section('title','Settings') --}}
    <div id="main" class="bigg-main">
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
                                    <h1 class="card-title text-light">UPDATE STAFF FORM</h1>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="{{ url('staffs/'.$staff->id)}}" method="POST" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                            <label for="hotel">Choose Hotel</label>
                                                            <div class="position-relative">
                                                                <select class="form-control" id="hotel_id" name="hotel_id">
                                                                    <option value="">Choose Hotel</option>
                                                                    @foreach ($hotelData as $value)
                                                                        <option value="{{ $value->id }}" 
                                                                            {{ old('hotel_id', $staff->hotel_id) == $value->id ? 'selected' : '' }}>
                                                                            {{ $value->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-bootstrap-reboot"></i>
                                                                </div>
                                                            </div>
                                                            @error('hotel_id')
                                                                <p class="text-danger mt-1" > {{ $message }} </p>
                                                            @enderror
                                                            
                                                    </div>
                                                </div>
                                                 <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                            <label for="phone">Phone</label>
                                                            <div class="position-relative"> 
                                                                <input type="text" class="form-control"placeholder="Phone number"id="phone" name="phone" value="{{ $staff -> phone }}" >
                                                                <div class="form-control-icon"><i class="bi bi-telephone"></i></div>
                                                            </div>
                                                            @error('phone')
                                                                <p class="text-danger mt-1" > {{ $message }} </p>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-2"> 
                                                    <div class="form-group has-icon-left">
                                                            <label for="first-name-icon">Name</label>
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control" placeholder="Stuff Name here" id="name" name="name" value="{{ $staff -> name }}">
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
                                                            <label for="Address">Address</label>
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control" placeholder="Address here" id="address" name="address" value="{{ $staff -> address }}">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-geo-alt"></i>
                                                                </div>
                                                            </div>
                                                            @error('address')
                                                                <p class="text-danger mt-1" > {{ $message }} </p>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                            <label for="gender">Gender</label>
                                                            <div class="position-relative">
                                                                <select class="form-control" id="gender" name="gender">
                                                                    <option value="Male" {{ (old('gender') ?? $staff->gender) == "Male" ? 'selected' : '' }}>Male</option>
                                                                    <option value="Female" {{ (old('gender') ?? $staff->gender) == "Female" ? 'selected' : '' }}>Female</option>
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
                                                            <label for="email">Email</label>
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control"
                                                                    placeholder="Email"
                                                                    id="email" name="email" value="{{ $staff -> email }}">
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
                                                            <label for="gender">Position</label>
                                                            <div class="position-relative">
                                                                <select class="form-control" id="position" name="position">
                                                                    <option value="" disabled {{ old('position', $staff->position) ? '' : 'selected' }}>Choose Position</option>
                                                                    <option value="Admin" {{ (old('position') ?? $staff->position) == 'Admin' ? 'selected' : '' }}>Admin</option>
                                                                    <option value="Manager" {{ (old('position') ?? $staff->position) == 'Manager' ? 'selected' : '' }}>Manager</option>
                                                                    <option value="GeneralMG" {{ (old('position') ?? $staff->position) == 'GeneralMG' ? 'selected' : '' }}>General Manager</option>
                                                                    <option value="Leader" {{ (old('position') ?? $staff->position) == 'Leader' ? 'selected' : '' }}>Leader</option>
                                                                    <option value="User" {{ (old('position') ?? $staff->position) == 'User' ? 'selected' : '' }}>User</option>
                                                                </select>
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-bootstrap-reboot"></i>
                                                                </div>
                                                            </div>
                                                            @error('position')
                                                                <p class="text-danger mt-1" > {{ $message }} </p>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 mb-4">
                                                    {{-- <div class="form-group has-icon-left"> --}}
                                                            <label for="fileUpload" name="file Progile">Upload File</label>
                                                            <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                                                    {{-- </div> --}}
                                                            @error('profile_photo')
                                                                <p class="text-danger mt-1" > {{ $message }} </p>
                                                            @enderror
                                                </div>
                                                
                                                <div class="col-12 d-flex justify-content-end">
                                                    <a href="{{ route('staffs.index') }}" type="reset" class="btn btn-danger me-2 mb-1 pe-4 ps-4"><i class="bi bi-arrow-left-circle-fill me-1"></i> Back</a>
                                                    <button type="submit"class="btn btn-primary me-3 mb-1 pe-4 ps-4"><i class="bi bi-floppy2 me-1"></i> Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
            </div>
@endsection()