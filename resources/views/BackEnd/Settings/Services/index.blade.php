@extends('BackEnd.Layouts.master')
@section('contents')
@section('Hotels-Settings','active')
@section('Setting-Detail','dd')
@section('title','Service Setting')
@section('services','active')
<div id="main" class="p-4 light-mode">
   <div class="modal fade" id="deleteModal" tabindex="-1">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header bg-danger">
               <h5 class="modal-title text-dark">Delete Service</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-dark">
               Are you sure you want to delete this Service?
            </div>
            <div class="modal-footer">
               <form id="deleteForm" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-danger">Yes, Delete</button>
               </form>
            </div>
         </div>
      </div>
   </div>
   <script>
      var deleteModal = document.getElementById('deleteModal');
      
      deleteModal.addEventListener('show.bs.modal', function (event) {
          var button = event.relatedTarget;
          var serviceId = button.getAttribute('data-id');
      
          var form = document.getElementById('deleteForm');
          form.action = '/services/' + serviceId;
      });
   </script>
   <style>
      .myshadow{
      box-shadow: 0 5px 15px rgba(255, 255, 255, 0.175);
      }
   </style>
   {{-- Header --}}
   <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
         <h4 class="fw-bold text-primary">Services Management</h4>
         <small class="text-muted">Manage all your Services</small>
      </div>
      {{-- <a href="{{ route('customers.create') }}" class="btn btn-primary" id="addUserModalLabel">
      + New Customer
      </a> --}}
      <button class="btn btn-primary"
         data-bs-toggle="modal"
         data-bs-target="#addUserModal">
      + New Services
      </button>
   </div>
   {{-- ================================================================================================================== --}}
   <div class="row mb-4">
      <div class="col-md-3">
         <div class="card border-0 myshadow p-2" style="border-radius:12px;">
            <div class="card-body d-flex align-items-center gap-3 p-3">
               {{-- Icon Box --}}
               <div class="p-2">
                  <i class="bi bi-gear-wide-connected text-primary fs-2"></i>
               </div>
               {{-- Text --}}
               <div>
                  <small class="text-muted d-block" style="font-size:18px;">
                  Total Services
                  </small>
                  <h3 class="fw-bold mb-0 text-primary">
                     {{ $myServices->total() }}
                  </h3>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-3">
         <div class="card border-0 myshadow p-2" style="border-radius:12px;">
            <div class="card-body d-flex align-items-center gap-3 p-3">
               {{-- Icon Box --}}
               <div class="p-2">
                  <i class="bi bi-radioactive text-primary fs-2"></i>
               </div>
               {{-- Text --}}
               <div>
                  <small class="text-muted d-block" style="font-size:18px;">
                  Status Active Count
                  </small>
                  <h3 class="fw-bold mb-0 text-primary">
                     {{ $activeCount }}
                  </h3>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-3">
         <div class="card border-0 myshadow p-2" style="border-radius:12px;">
            <div class="card-body d-flex align-items-center gap-3 p-3">
               {{-- Icon Box --}}
               <div class="p-2">
                  <i class="bi bi-hypnotize text-primary fs-2"></i>
               </div>
               {{-- Text --}}
               <div>
                  <small class="text-muted d-block" style="font-size:18px;">
                  Status Inactive Count
                  </small>
                  <h3 class="fw-bold mb-0 text-primary">
                     {{ $inActiveCount }}
                  </h3>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-3">
         <div class="card border-0 myshadow p-2" style="border-radius:12px;">
            <div class="card-body d-flex align-items-center gap-3 p-3">
               {{-- Icon Box --}}
               <div class="p-2">
                  <i class="bi bi-motherboard text-primary fs-2"></i>
               </div>
               {{-- Text --}}
               <div>
                  <small class="text-muted d-block" style="font-size:18px;">
                  Others
                  </small>
                  <h3 class="fw-bold mb-0 text-primary">
                     {{-- {{ $femaleCount }} --}}
                  </h3>
               </div>
            </div>
         </div>
      </div>
   </div>
   {{-- Table Card --}}
   <div class="card shadow-sm border-0">
      <div class="card-body">
         {{-- Search --}}
         <form method="GET" action="{{ route('services.index') }}">
            <div class="d-flex mb-3">
               <input type="text" name="search" class="form-control w-25" placeholder="Search Services..." value="{{ request('search') }}">
               <button type="submit" class="btn btn-primary ms-2"><i class="bi bi-search me-1"></i>Search</button>
            </div>
         </form>
         <div class="table-responsive"  id="customerTable">
            <table class="table align-middle" >
               <thead class="text-muted">
                  <tr>
                     <th>Name</th>
                     <th>Hotel Name</th>
                     <th style="width: 25%">Detail</th>
                     <th>Status</th>
                     <th>Profile</th>
                     <th class="text-center">Actions</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse ($myServices as $value)
                  <tr>
                    <td class="fw-semibold">{{ $value->name }}</td>
                    <td>{{ $value->hotel->name }}</td>
                    <td>{{ $value->detail }}</td>
                    <td class="text-center">
                        @if(($value->status) == "active") 
                            <div class="p-2 bg-success text-light w-50 text-center rounded-5"> Active </div>
                        @else
                            <div class="p-2 bg-warning text-dark w-50 text-center rounded-5"> Inactive </div>
                        @endif
                    </td>
                     <td>
                        @if($value->profile_photo)
                        <img src="{{ asset('assets/uploads/servicesIMG/'.$value->profile_photo) }}"
                           width="45" height="45"
                           style="border-radius:50%; object-fit:cover;">
                        @else
                        <span class="text-muted">No Image</span>
                        @endif
                     </td>
                     <td class="text-center">
                        <a href="{{ ('services/').$value->id }}" class="btn btn-sm btn-primary me-1">
                        <i class="bi bi-eye-fill"></i>
                        </a>
                        <a href="{{ route('services.edit',$value->id) }}" class="btn btn-sm btn-success me-1">
                        <i class="bi bi-pencil-square"></i>
                        </a>
                        <button class="btn btn-outline-danger btn-sm btn-danger"
                           data-bs-toggle="modal"
                           data-bs-target="#deleteModal"
                           data-id="{{ $value->id }}">
                        <i class="bi bi-trash3"></i>
                        </button>
                     </td>
                  </tr>
                  @empty
                  <tr>
                     <td colspan="9" class="text-center text-danger">
                        No Data Found
                     </td>
                  </tr>
                  @endforelse
               </tbody>
            </table>
         </div>
         {{-- Pagination --}}
         <div class="d-flex justify-content-end mt-3">
            {{ $myServices->appends(request()->query())->links() }}
         </div>
      </div>
   </div>
</div>
<!-- Add Customer Modal -->
<div class="modal fade active" id="addUserModal" tabindex="-1">
   <div class="modal-dialog modal-lg">
      <div class="modal-content p-3">
         <!-- Header -->
         <div class="modal-header">
            <h5 class="modal-title">Add New Services</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
         </div>
         <!-- Body -->
         <div class="modal-body">
            <form class="form" action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
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
                                {{ old('hotel_id') == $value->id ? 'selected' : '' }}>
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
                           <input type="text" class="form-control" placeholder="Services Name here" id="name" name="name" value="{{ old('name') }}">
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
                           <input type="text" class="form-control" placeholder="Detail here" id="detail" name="detail" value="{{ old('detail') }}">
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
                           <option value="active" {{ old('status') == "active" ? 'selected' : '' }} >Active</option>
                           <option value="inactive" {{ old('status') == "inactive" ? 'selected' : ''}} >Inactive</option>
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
                     <button type="submit"class="btn btn-primary me-3 mb-1 pe-4 ps-4"><i class="bi bi-floppy2 me-1"></i> Save</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
</div>
<style>
   /* Modal background */
   .dark-mode .modal-content {
   background-color: #1e1e1e;
   color: #fff;
   }
   /* Header + footer */
   .dark-mode .modal-header,
   .dark-mode .modal-footer {
   border-color: #444;
   }
   /* Inputs */
   .dark-mode .form-control {
   background-color: #2c2c2c;
   color: #fff;
   border: 1px solid #444;
   }
   /* Select */
   .dark-mode select.form-control {
   background-color: #2c2c2c;
   color: #fff;
   }
   /* Placeholder */
   .dark-mode .form-control::placeholder {
   color: #aaa;
   }
   /* Labels */
   .dark-mode label {
   color: #ddd;
   }
   /* Icons inside input */
   .dark-mode .form-control-icon {
   color: #aaa;
   }
   /* Fix autofill (Chrome bug) */
   .dark-mode input:-webkit-autofill {
   -webkit-box-shadow: 0 0 0 1000px #2c2c2c inset !important;
   -webkit-text-fill-color: #fff !important;
   }
   .light-mode{
   background-color: rgba(140, 149, 158, 0.222);
   }
   .modal-content{
   /* background-color: rgba(179, 191, 192, 0.969); */
   background-color:rgba(188, 188, 188, 0.999);
   }
</style>
</div>
@endsection()