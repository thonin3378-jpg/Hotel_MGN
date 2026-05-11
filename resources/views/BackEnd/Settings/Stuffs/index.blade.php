@extends('BackEnd.Layouts.master')
@section('contents')
@section('Setting-Privatecy','active')
@section('title','Staff Setting')
@section('staffs','active')
<div id="main" class="p-4 light-mode">
   <div class="modal fade" id="deleteModal" tabindex="-1">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header bg-danger">
               <h5 class="modal-title text-dark">Delete Staff</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-dark">
               Are you sure you want to delete this staff?
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
          var staffId = button.getAttribute('data-id');
      
          var form = document.getElementById('deleteForm');
          form.action = '/staffs/' + staffId;
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
         <h4 class="fw-bold text-primary">Staff Management</h4>
         <small class="text-muted">Manage all your staffs</small>
      </div>
      {{-- <a href="{{ route('customers.create') }}" class="btn btn-primary" id="addUserModalLabel">
      + New Customer
      </a> --}}
      <button class="btn btn-primary"
         data-bs-toggle="modal"
         data-bs-target="#addUserModal">
      + New Staff
      </button>
   </div>
   {{-- ================================================================================================================== --}}
   <div class="row mb-4">
      <div class="col-md-3">
         <div class="card border-0 myshadow p-2" style="border-radius:12px;">
            <div class="card-body d-flex align-items-center gap-3 p-3">
               {{-- Icon Box --}}
               <div class="p-2">
                  <i class="bi bi-people-fill text-primary fs-2"></i>
               </div>
               {{-- Text --}}
               <div>
                  <small class="text-muted d-block" style="font-size:18px;">
                  Total Staff
                  </small>
                  <h3 class="fw-bold mb-0 text-primary">
                     {{ $myStaff->total() }}
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
                  <i class="bi bi-bag-fill text-primary fs-2"></i>
               </div>
               {{-- Text --}}
               <div>
                  <small class="text-muted d-block" style="font-size:18px;">
                  Admin Count
                  </small>
                  <h3 class="fw-bold mb-0 text-primary">
                     {{ $adminCount }}
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
                  <i class="bi bi-person-raised-hand text-primary fs-2"></i>
               </div>
               {{-- Text --}}
               <div>
                  <small class="text-muted d-block" style="font-size:18px;">
                  Male
                  </small>
                  <h3 class="fw-bold mb-0 text-primary">
                     {{ $maleCount }}
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
                  <i class="bi bi-person-standing-dress text-primary fs-2"></i>
               </div>
               {{-- Text --}}
               <div>
                  <small class="text-muted d-block" style="font-size:18px;">
                  Female
                  </small>
                  <h3 class="fw-bold mb-0 text-primary">
                     {{ $femaleCount }}
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
         <form method="GET" action="{{ route('staffs.index') }}">
            <div class="d-flex mb-3">
               <input type="text" name="search" class="form-control w-25" placeholder="Search customer..." value="{{ request('search') }}">
               <button type="submit" class="btn btn-primary ms-2"><i class="bi bi-search me-1"></i>Search</button>
            </div>
         </form>
         <div class="table-responsive"  id="customerTable">
            <table class="table align-middle" >
               <thead class="text-muted">
                  <tr>
                     <th>Name</th>
                     <th>Gender</th>
                     <th>Hotel</th>
                     <th>Position</th>
                     <th>Address</th>
                     <th>Phone</th>
                     <th>Email</th>
                     <th>Profile</th>
                     <th class="text-center">Actions</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse ($myStaff as $value)
                  <tr>
                     <td class="fw-semibold">{{ $value->name }}</td>
                     <td>{{ $value->gender }}</td>
                     <td>{{ $value->hotel->name }}</td>
                     <td>{{ $value->position }}</td>
                     <td>{{ $value->address }}</td>
                     <td>{{ $value->phone }}</td>
                     <td>{{ $value->email }}</td>
                     <td>
                        @if($value->profile_photo)
                        <img src="{{ asset('assets/uploads/staff/'.$value->profile_photo) }}"
                           width="45" height="45"
                           style="border-radius:50%; object-fit:cover;">
                        @else
                        <span class="text-muted">No Image</span>
                        @endif
                     </td>
                     <td class="text-center">
                        <a href="{{ ('staffs/').$value->id }}" class="btn btn-sm btn-primary me-1">
                        <i class="bi bi-eye-fill"></i>
                        </a>
                        <a href="{{ route('staffs.edit',$value->id) }}" class="btn btn-sm btn-success me-1">
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
            {{ $myStaff->appends(request()->query())->links() }}
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
            <h5 class="modal-title">Add New Customer</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
         </div>
         <!-- Body -->
         <div class="modal-body">
            <form class="form" action="{{ route('staffs.store') }}" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="row">
                  <div class="col-md-6 col-12 mb-2">
                     <div class="form-group has-icon-left">
                        <label for="hotel">Choose Hotel</label>
                        <div class="position-relative">
                           <select class="form-control" id="hotel_id" name="hotel_id" value="old('hotel_id')">
                              <option value="">Choose Hotel</option>
                              @foreach ($hotelData as $value)
                              <option value="{{ $value->id }}"
                              {{ old('hotel_id') == $value->id ? 'selected' : '' }}>
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
                           <input type="text" class="form-control"placeholder="Phone number"id="phone" name="phone" value="{{ old('phone') }}" >
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
                           <input type="text" class="form-control" placeholder="Stuff Name here" id="name" name="name" value="{{ old('name') }}">
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
                           <input type="text" class="form-control" placeholder="Address here" id="address" name="address" value="{{ old('address') }}">
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
                           <option value="Male" {{ old('gender') == "Male" ? 'selected' : '' }} >Male</option>
                           <option value="Female" {{ old('gender') == "Female" ? 'selected' : ''}} >Female</option>
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
                  <div class="col-md-12 col-12 mb-2">
                     <div class="form-group has-icon-left">
                        <label for="gender">Position</label>
                        <div class="position-relative">
                           <select class="form-control" id="position" name="position">
                           <option value="" disabled {{ old('position') ? '' : 'selected' }} >Choose Positon</option>
                           <option value="Admin" {{ old('position') == 'Admin' ? 'selected' : '' }}>Admin</option>
                           <option value="Manager" {{ old('position') == 'Manager' ? 'selected' : '' }}>Manager</option>
                           <option value="GeneralMG" {{ old('position') == 'GeneralMG' ? 'selectde' : '' }}  ></option>>General Manager</option>
                           <option value="Leader" {{ old('position') == 'Leader' ? 'selected' : '' }} >Leader</option>
                           <option value="User" {{ old('position') == 'User' ? 'selected' : '' }}>User</option>
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
                     <a href="{{ route('staffs.index') }}" type="reset" class="btn btn-danger me-2 mb-1 pe-4 ps-4"><i class="bi bi-arrow-left-circle-fill me-1"></i> Back</a>
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