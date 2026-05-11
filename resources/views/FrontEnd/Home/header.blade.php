<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>Bussiness Hotell</title>
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <meta content="" name="keywords">
      <meta content="" name="description">
      @vite(['resources/css/app.css', 'resources/js/app.js'])
      <!-- Favicon -->
      <link href="{{ asset('img/favicon.ico') }}" rel="icon">
      <!-- Google Web Fonts -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
      <!-- Icon Font Stylesheet -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
      <!-- Libraries Stylesheet -->
      <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
      <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
      <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
      <!-- Customized Bootstrap Stylesheet -->
      <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
      <!-- Template Stylesheet -->
      <link href="{{ asset('css/style.css') }}" rel="stylesheet">
      <style>
         .container-xxlll{
         /* width: 1700px; */
         background-color: rgba(255, 255, 255, 0.732);
         /* color: white */
         }
         .mypointer{
            /* background-color: #111111; */
            cursor: pointer;
            
         }
      </style>
   </head>
   <body>
      <div class="container-xxlll">
      <!-- Spinner Start -->
      <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
         <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
         </div>
      </div>
      <!-- Spinner End -->
      <!-- Header Start -->
      <div class="container-fluid bg-dark px-0">
         <div class="row gx-0">
            <div class="col-lg-3 bg-dark d-none d-lg-block">
               <a href="index.html" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                  <h1 class="m-0 text-primary text-uppercase">B.S Hotel</h1>
               </a>
            </div>
            <div class="col-lg-9">
               <div class="row gx-0 bg-white d-none d-lg-flex">
                  <div class="col-lg-7 px-5 text-start">
                     <div class="h-100 d-inline-flex align-items-center py-2 me-4">
                        <i class="fa fa-envelope text-primary me-2"></i>
                        <p class="mb-0">businessHotel.me@gmail.com</p>
                     </div>
                     <div class="h-100 d-inline-flex align-items-center py-2">
                        <i class="fa fa-phone-alt text-primary me-2"></i>
                        <p class="mb-0">+855 8791 3747</p>
                     </div>
                  </div>
                  
                  <div class="col-lg-5 px-5 text-end">
                     <div class="d-inline-flex align-items-center py-2 mypointer">
                        <div class="nav-item dropdown menu-open @yield('settings')">
                           <a href="#" class="nav-link" data-bs-toggle="dropdown"><i class="bi bi-gear-fill fs-4"></i></a>
                           <div class="dropdown-menu rounded-0 m-0">
                              {{-- <a href="{{ route('Pagebooking.index') }}" class="dropdown-item @yield('booking')">Booking</a> --}}
                              <a href="{{ route('FrontendLogin') }}"><i class="bi bi-pencil-square me-1"></i>Setting</a> |
                              <a href="{{ route('Frontendlogout') }}"><i class="bi bi-box-arrow-left me-1"></i> Logout</a>
                           </div>
                        </div>
                        <a class="me-3" href="{{ route('bookingsReceipt.index') }}"><i class="bi bi-cart-check-fill fs-4"></i></a>
                       @if(auth('customer')->check())
                            <div class="profile">
                                <span class="me-2">
                                    Welcome {{ auth('customer')->user()->name }}
                                </span>

                                <img src="{{ auth('customer')->user()?->profile_photo
                                    ? asset('assets/uploads/customers/' . auth('customer')->user()->profile_photo)
                                    : asset('assets/default.png') }}"
                                    alt="profile" width="35" style="border-radius: 10px ">
                            </div>
                        @else
                            <a href="{{ route('FrontendLogin') }}">Login</a>
                        @endif
                     </div>
                  </div>
               </div>
               
               <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0">
                  <a href="#" class="navbar-brand d-block d-lg-none">
                     <h1 class="m-0 text-primary text-uppercase">Hotelier</h1>
                  </a>
                  <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                  <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse justify-content-around w-100" id="navbarCollapse">
                     <div class="navbar-nav mr-auto py-0 w-75">
                        <a href="{{ route('home.index') }}" class="nav-item nav-link @yield('home')">Home</a>
                        <a href="{{ route('about.index') }}" class="nav-item nav-link @yield('about')">About</a>
                        <a href="{{ route('service.index') }}" class="nav-item nav-link @yield('service')">Services</a>
                        <a href="{{ route('roomss.index') }}" class="nav-item nav-link @yield('rooms')">Roomsss</a>
                        <div class="nav-item dropdown menu-open @yield('Pages')">
                           <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                           <div class="dropdown-menu rounded-0 m-0">
                              {{-- <a href="{{ route('Pagebooking.index') }}" class="dropdown-item @yield('booking')">Booking</a> --}}
                              <a href="{{ route('ourTeam.index') }}" class="dropdown-item @yield('ourTeam')">Our Team</a>
                              <a href="{{ route('testimonial.index') }}" class="dropdown-item @yield('Testimonial')">Testimonial</a>
                           </div>
                        </div>
                        <a href="{{ route('contact.index') }}" class="nav-item nav-link @yield('contact')">Contact</a>
                        <a href="{{ route('booking.index') }}" class="nav-item nav-link @yield('Booking')">Booking</a>
                     </div>
                     <a href="{{ route('dashboard.index') }}" target="_blank" class="btn btn-primary rounded-0 py-4 px-md-5 d-none d-lg-block w-25">Dashboard Admin<i class="fa fa-arrow-right ms-3"></i></a>
                  </div>
               </nav>
            </div>
         </div>
      </div>
      <!-- Logout Modal -->
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure that you wanna logout your account?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                <a href="{{ route('logout') }}" type="button" class="btn btn-danger">Logout</a>
            </div>
            </div>
        </div>
    </div> --}}

      <!-- Update Profile Modal -->
        <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                <div class="modal-header">
                    <h5 class=" text-center" id="staticBackdropLabel">Add Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form" action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-12 mb-2">
                            <div class="form-group has-icon-left">
                                <label for="first-name-icon">Name</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control" placeholder="Name here" id="name" name="name" value="{{ old('name') }}">
                                    
                                </div>
                                @error('name')
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
                                        id="email" name="email" value="{{ old('email') }}">
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
                                <label for="gender">Gender</label>
                                <div class="position-relative">
                                    <select class="form-control" id="gender" name="gender">
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : ''}} >Male</option>
                                    <option value="Female"{{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
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
                                    <label for="phone">Phone</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control"placeholder="Phone number"id="phone" name="phone" value="{{ old('phone') }}" >
                                        
                                    </div>
                                    @error('phone')
                                    <p class="text-danger mt-1" > {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-12 mb-2 mt-2">
                                <div class="form-group has-icon-left">
                                    <label for="password">Password</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control"placeholder="password"id="password" name="password" value="{{ old('password') }}" >
                                        
                                    </div>
                                    @error('password')
                                    <p class="text-danger mt-1" > {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-12 mb-4 mt-3">
                                {{-- 
                                <div class="form-group has-icon-left"> --}}
                                    <label for="fileUpload" name="file Progile">Upload File</label>
                                    <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                                    {{-- 
                                </div>
                                --}}
                            @error('profile_photo')
                            <p class="text-danger mt-1" > {{ $message }} </p>
                            @enderror
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                            <a href="{{ route('home.index') }}" type="reset" class="btn btn-danger me-2 mb-1 pe-4 ps-4"><i class="bi bi-arrow-left-circle-fill me-1"></i> Back</a>
                            <button type="submit"class="btn btn-primary me-3 mb-1 pe-4 ps-4"><i class="bi bi-floppy2 me-1"></i> Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
        <style>
            .hello{
                width: 500px;
                /* background-color: deeppink; */
            }
        </style>