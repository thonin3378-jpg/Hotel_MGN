@extends('BackEnd.Layouts.master')
@section('contents')
@section('title','Update Users')
    <div id="main">
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
                <div class="card add-form-body" data-aos="fade-up">
                                <div class="card-header text-center bg-primary">
                                    <h1 class="card-title text-light">UPDATE USER FORM</h1>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" method="POST" action="{{ url('users/'.$myUser->id) }}">
                                            @method('PUT')
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                            <label for="staff_id">Choose Staff</label>
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control"
                                                                    value="{{ $myUser->staff->name }}"
                                                                    readonly>

                                                                <!-- Send real staff_id -->
                                                                <input type="hidden" name="staff_id" value="{{ $myUser->staff_id }}">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-bootstrap-reboot"></i>
                                                                </div>
                                                            </div>
                                                            @error('staff_id')
                                                                <p class="text-danger mt-1"> {{ $message }} </p>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                            <label for="password">Password</label>
                                                            <div class="position-relative">
                                                                <input type="password" class="form-control"
                                                                    placeholder="Password"
                                                                    id="password" name="password" value=" {{ $myUser->password }} ">
                                                                    <div class="form-control-icon Mypassword"><i class="bi bi-eye" id="toggleIcon" onclick="togglePassword()"></i></div>
                                                                    
                                                            </div>
                                                             @error('password')
                                                                <p class="text-danger mt-1"> {{ $message }} </p>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 mb-2">
                                                    <div class="form-group has-icon-left">
                                                            @php
                                                                $myRole = ['Admin','Staff','Manager','Leader','CEO'];
                                                            @endphp
                                                            <label for="role">Role</label>
                                                            <div class="position-relative">
                                                                <select class="form-control" id="role" name="role">
                                                                    @foreach ($myRole as $value )
                                                                        <option value="{{$value}}" 
                                                                            {{ $myUser->role == $value ? 'selected' : ''}} >
                                                                            {{$value}}
                                                                        </option>
                                                                    @endforeach
                                                                     {{-- @foreach ($myRole as $role)
                                                                        <option value="{{ $role }}" 
                                                                            {{ $myUser->role == $role ? 'selected' : '' }}>
                                                                            {{ $role }}
                                                                        </option>
                                                                    @endforeach --}}
                                                                </select>
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-bootstrap-reboot"></i>
                                                                </div>
                                                            </div>
                                                             @error('role')
                                                                <p class="text-danger mt-1"> {{ $message }} </p>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <a href="{{ route('users.index') }}" type="reset" class="btn btn-danger me-2 mb-1 pe-4 ps-4"><i class="bi bi-arrow-left-circle-fill me-1"></i> Back</a>
                                                    <button type="submit"class="btn btn-primary me-3 mb-1 pe-4 ps-4"><i class="bi bi-floppy2 me-1"></i> Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
            </div>
            <style>
                .add-form-body{
                    border-radius: 10px;
                    background-color: #d5d5d58c;
                    box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px, rgba(0, 0, 0, 0.05) 0px 5px 10px;
                }
                .Mypassword{
                    cursor: pointer;
                }
            </style>
            <script>
                function togglePassword() {
                    const password = document.getElementById("password");
                    const icon = document.getElementById("toggleIcon");

                    if (password.type === "password") {
                        password.type = "text";
                        icon.classList.remove("bi-eye");
                        icon.classList.add("bi-eye-slash");
                    } else {
                        password.type = "password";
                        icon.classList.remove("bi-eye-slash");
                        icon.classList.add("bi-eye");
                    }
                }
            </script>
@endsection()