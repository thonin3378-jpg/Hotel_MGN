@extends('BackEnd.Layouts.master')
@section('contents')
@section('Setting-Privatecy','')
@section('Setting-Detail','')
@section('Hotels-Settings','active')
@section('Hotel','active')
@section('title','Hotels Setting')
<div id="main" class="p-4 light-mode">
   <div class="modal fade" id="deleteModal" tabindex="-1">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header bg-danger">
               <h5 class="modal-title text-dark">Delete Hotels</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-dark">
               Are you sure you wanna delete this Hotels?
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
          var hotelId = button.getAttribute('data-id');
      
          var form = document.getElementById('deleteForm');
          form.action = '/hotels/' + hotelId;
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
         <h4 class="fw-bold text-primary">Hotels Management</h4>
         <small class="text-muted">Manage all your Hotels</small>
      </div>
      <div class="div d-flex gap-3">
        <button class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#addUserModal">
            <i class="bi bi-building-add me-2"></i>
            New Hotels
        </button>
        <button class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#addHotelModalImage">
            <i class="bi bi-image-fill me-2"></i>
            Add Image
        </button>
        <button class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#showHotelModalImage">
            <i class="bi bi-list-stars me-2"></i>
            List Image Hotel
        </button>
      </div>
   </div>
   {{-- ================================================================================================================== --}}
   <div class="row mb-4">
      <div class="col-md-3">
         <div class="card border-0 myshadow p-2" style="border-radius:12px;">
            <div class="card-body d-flex align-items-center gap-3 p-3">
               {{-- Icon Box --}}
               <div class="p-2">
                  <i class="bi bi-hospital fs-2"></i>
               </div>
               {{-- Text --}}
               <div>
                  <small class="text-muted d-block" style="font-size:18px;">
                  Total Hotels
                  </small>
                  <h3 class="fw-bold mb-0 text-primary">
                     {{ $myHotel->total() }}
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
                  <i class="bi bi-bootstrap fs-2"></i>
               </div>
               {{-- Text --}}
               <div>
                  <small class="text-muted d-block" style="font-size:18px;">
                    Hotels Booking
                  </small>
                  <h3 class="fw-bold mb-0 text-primary">
                     {{ $bookingCount }}
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
                  <i class="bi bi-hospital fs-2 "></i>
               </div>
               {{-- Text --}}
               <div>
                  <small class="text-muted d-block" style="font-size:18px;">
                  Hotel Free
                  </small>
                  <h3 class="fw-bold mb-0 text-primary">
                     {{ $freeCount }}
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
                  <i class="bi bi-map fs-2"></i>
               </div>
               {{-- Text --}}
               <div>
                  <small class="text-muted d-block" style="font-size:18px;">
                  Total Province
                  </small>
                  <h3 class="fw-bold mb-0 text-primary">
                     {{ $provinceCount  }}
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
        <form method="GET" action="{{ route('hotels.index') }}">
            <div class="d-flex mb-3">
                <input type="text" name="search" class="form-control w-25" placeholder="Search Hotels Address ...." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary ms-2"><i class="bi bi-search me-1"></i>Search</button>
            </div>
        </form>
         <div class="table-responsive"  id="customerTable">
            <table class="table align-middle" >
               <thead class="text-muted">
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th class="text-center">Actions</th>
                    </tr>
               </thead>
               <tbody>
                    @forelse ($myHotel as $value)
                        <tr>
                            <td class="fw-semibold">{{ $value->name }}</td>
                            <td>{{ $value->address }}</td>
                            <td>{{ $value->email }}</td>
                            <td class="text-center">
                                @if(($value->status) == 0) 
                                    <div class="p-2 bg-success text-light w-50 text-center rounded-5"> Booking </div>
                                @else
                                    <div class="p-2 bg-warning text-dark w-50 text-center rounded-5"> Free </div>
                                @endif
                            </td>
                            <td>
                                @if($value->profile_photo)
                                    <img src="{{ asset('assets/uploads/hotels/'.$value->profile_photo) }}"
                                        width="45" height="45"
                                        style="border-radius:50%; object-fit:cover;">
                                    @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{('hotels/').$value->id }}" class="btn btn-sm btn-primary me-1">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a href="{{ route('hotels.edit',$value->id) }}" class="btn btn-sm btn-success me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                @if($value->status == 0)
                                    <button class="btn btn-warning btn-sm" disabled title="Currently Booking">
                                       <i class="bi bi-lock"></i>
                                    </button>
                                 @else
                                    <button class="btn btn-danger btn-sm"
                                       data-bs-toggle="modal"
                                       data-bs-target="#deleteModal"
                                       data-id="{{ $value->id }}">
                                       <i class="bi bi-trash3"></i>
                                    </button>
                                 @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-danger">
                                No Data Found
                            </td>
                        </tr>
                    @endforelse
               </tbody>
            </table>
         </div>
         {{-- Pagination --}}
         <div class="d-flex justify-content-end mt-3">
           {{ $myHotel->appends(request()->query())->links() }}
         </div>
      </div>
   </div>
</div>
{{-- ================================================================================================================== --}}
<!-- Add Hotel Modal -->
<div class="modal fade active" id="addUserModal" tabindex="-1">
   <div class="modal-dialog modal-lg">
      <div class="modal-content p-3">
         <!-- Header -->
         <div class="modal-header">
            <h5 class="modal-title">Add New Hotels</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
         </div>
         <!-- Body -->
         <div class="modal-body">
            <form class="form" action="{{ route('hotels.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-12 mb-2">
                        <div class="form-group has-icon-left">
                            <label for="first-name-icon">Name</label>
                            <div class="position-relative">
                            <input type="text" class="form-control"
                                placeholder="Hotel Name here"
                                id="first-name-icon" name="name">
                            <div class="form-control-icon">
                                <i class="bi bi-house"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-6 col-12 mb-2">
                        <div class="form-group has-icon-left">
                            <label for="email">Email</label>
                            <div class="position-relative">
                            <input type="text" class="form-control"
                                placeholder="Email"
                                id="email" name="email">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope-at"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-12 mb-2">
                        <div class="form-group has-icon-left">
                            <label for="Addrress">Addrress</label>
                            <div class="position-relative">
                            <select class="form-control" id="addrress" name="address">
                                <option value="" disabled selected>Choose Hotel Address</option>
                                <option value="PhnomPenh">Phnom Penh</option>
                                <option value="SiemReab">Siem Reab</option>
                                <option value="Kompot">Kompot</option>
                                <option value="Takav">Takav</option>
                                <option value="KompongChnang">Kompong Chnang</option>
                            </select>
                            <div class="form-control-icon">
                               <i class="bi bi-geo-alt"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-12 mb-2">
                        <div class="form-group has-icon-left">
                            <label for="Status">Status</label>
                            <div class="position-relative">
                            <select class="form-control" id="status" name="status">
                                <option value="1">Free</option>
                                <option value="0">Booking</option>
                            </select>
                            <div class="form-control-icon">
                                <i class="bi bi-exclamation-circle"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-12 mb-4">
                        {{-- 
                        <div class="form-group has-icon-left"> --}}
                            <label for="fileUpload">Upload File</label>
                            <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                            {{-- 
                        </div>
                        --}}
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <a href="{{ route('hotels.index') }}" type="reset"
                            class="btn btn-light-secondary me-1 mb-1">Back</a>
                        <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
                    </div>
                </div>
            </form>
         </div>
      </div>
   </div>
</div>

{{-- ================================================================================================================== --}}
<!-- Add Image Hotel Modal -->
<div class="modal fade active" id="addHotelModalImage" tabindex="-1">
   <div class="modal-dialog modal-lg">
      <div class="modal-content p-3">
         <!-- Header -->
         <div class="modal-header">
            <h5 class="modal-title">Add Images Hotel</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
         </div>
         <!-- Body -->
         <div class="modal-body">
            <form class="form" action="{{ route('hotelImages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 col-12 mb-2">
                        <div class="form-group has-icon-left">
                            <label for="hotel">Choose Hotel to add Image</label>
                            <div class="position-relative">
                            <select class="form-control" id="addrress" name="hotel_id">
                                <option value="" disabled selected>Choose Hotel to add Image</option>
                                @foreach ($myHotel as $key => $value )
                                 <option value="{{$value->id}}"> {{ $value->name }} </option>
                                @endforeach
                            </select>
                            <div class="form-control-icon">
                               <i class="bi bi-geo-alt"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-12 mb-4">
                        {{-- 
                        <div class="form-group has-icon-left"> --}}
                            <label for="fileUpload">Upload File</label>
                            <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                            {{-- 
                        </div>
                        --}}
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <a href="{{ route('hotels.index') }}" type="reset"
                            class="btn btn-light-secondary me-1 mb-1">Back</a>
                        <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
                    </div>
                </div>
            </form>
         </div>
      </div>
   </div>
</div>


{{-- ================================================================================================================== --}}
<!-- list Images Hotel Modal -->
<div class="modal fade active" id="showHotelModalImage" tabindex="-1">
   <div class="modal-dialog modal-lg">
      <div class="modal-content p-3">
         <!-- Header -->
         <div class="modal-header">
            <h5 class="modal-title">List Images Hotel</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
         </div>
         <!-- Body -->
         <div class="modal-body">
            <div class="card shadow-sm border-0">
         <div class="card-body">
            {{-- Search --}}
            <form method="GET" action="{{ route('hotelImages.index') }}">
                  <div class="d-flex mb-3">
                     <select class="form-control" name="hotel_id">
                        <option value="">Choose Hotel</option>
                        @foreach ($myHotel as $value)
                           <option value="{{ $value->id }}"
                              {{ request('hotel_id') == $value->id ? 'selected' : '' }}>
                              {{ $value->name }}
                           </option>
                        @endforeach
                     </select>
                     <button type="submit" class="btn btn-primary ms-2"><i class="bi bi-search me-1"></i>Search</button>
                  </div>
            </form>
            <div class="table-responsive"  id="customerTable">
               <table class="table align-middle" >
                  <thead class="text-muted">
                     <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th class="text-center">Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse ($hotelImage as $value)
                        <tr>
                           <td>{{ $value->hotel->name ?? 'No Hotel' }}</td>
                           <td>
                              @if($value->profile_photo)
                                    <img src="{{ asset('assets/uploads/hotels/'.$value->profile_photo) }}"
                                       width="65" height="65">
                              @endif
                           </td>
                           <td class="text-center">
                              
                              <button class="btn btn-danger btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModalImage"
                                    data-id="{{ $value->id }}">
                                    <i class="bi bi-trash3"></i>
                              </button>
                           </td>
                        </tr>
                        @empty
                        <tr>
                           <td colspan="3" class="text-center text-danger">No Data</td>
                        </tr>
                        @endforelse
                  </tbody>
               </table>
               <button type="button" class="btn btn-danger mt-4 float-end" data-bs-dismiss="modal">Close</button>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-end mt-3">
            {{ $hotelImage->links() }}
            </div>
            
         </div>
      </div>
         </div>
      </div>
   </div>
</div>
{{-- Delete image modal --}}
            <div class="modal fade" id="deleteModalImage" tabindex="-1">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header bg-danger">
                        <h5 class="modal-title text-dark">Delete Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                     </div>
                     <div class="modal-body text-dark">
                        Are you sure you wanna delete this Image?
                     </div>
                     <div class="modal-footer">
                        <form id="deleteImageForm" method="POST">
                           @csrf
                           @method('DELETE')
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                           <button type="submit" class="btn btn-danger">Yes, Delete</button>
                        </form>
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
@if(request()->has('hotel_id'))
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var modal = new bootstrap.Modal(document.getElementById('showHotelModalImage'));
        modal.show();
    });
    document.addEventListener('DOMContentLoaded', function () {

    

});
</script>
@endif
<script>

   function openDeleteModal(id) {

      const imageModalEl = document.getElementById('showHotelModalImage');
      const imageModal = bootstrap.Modal.getInstance(imageModalEl);

      if (imageModal) {
         imageModal.hide();
      }

      // wait until fully closed BEFORE opening next modal
      imageModalEl.addEventListener('hidden.bs.modal', function handler() {

         document.getElementById('deleteImageForm').action = '/hotel-images/' + id;

         const deleteModal = new bootstrap.Modal(document.getElementById('deleteImageModal'));
         deleteModal.show();

         // remove listener so it won't trigger multiple times
         imageModalEl.removeEventListener('hidden.bs.modal', handler);
      });
   }
    var deleteModal = document.getElementById('deleteModalImage');

      deleteModal.addEventListener('show.bs.modal', function (event) {
         var button = event.relatedTarget;
         var id = button.getAttribute('data-id');

         var form = document.getElementById('deleteImageForm');
         form.action = '/hotelImages/' + id;
      });
</script>
@endsection()