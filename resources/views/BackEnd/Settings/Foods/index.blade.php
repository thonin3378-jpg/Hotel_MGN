@extends('BackEnd.Layouts.master')
@section('contents')
@section('Setting-Privatecy','')
@section('Setting-Detail','')
@section('Foods-Settings','active')
@section('Foods','active')
@section('title','Foods Setting')
<div id="main" class="p-4 light-mode">
   <div class="modal fade" id="deleteModal" tabindex="-1">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header bg-danger">
               <h5 class="modal-title text-dark">Delete Food</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-dark">
               Are you sure you wanna delete this Food?
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
          var foodsId = button.getAttribute('data-id');
      
          var form = document.getElementById('deleteForm');
          form.action = '/foods/' + foodsId;
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
         <h4 class="fw-bold text-primary">Foods Management</h4>
         <small class="text-muted">Manage all your Foods</small>
      </div>
      <div class="div d-flex gap-3">
         <button class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#addUserModal">
            <i class="bi bi-fork-knife me-2"></i>
            New Foods
         </button>
         <button class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#addHotelModalImage">
            <i class="bi  bi-braces-asterisk me-2"></i>
            Add Foods Type
         </button>
        {{-- <button class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#showHotelModalImage">
            <i class="bi bi-list-stars me-2"></i>
            List Image Hotel
        </button> --}}
      </div>
   </div>
   {{-- ================================================================================================================== --}}
   <div class="row mb-4">
      <div class="col-md-3">
         <div class="card border-0 myshadow p-2" style="border-radius:12px;">
            <div class="card-body d-flex align-items-center gap-3 p-3">
               {{-- Icon Box --}}
               <div class="p-2">
                  <i class="bi bi-fork-knife fs-2"></i>
               </div>
               {{-- Text --}}
               <div>
                  <small class="text-muted d-block" style="font-size:18px;">
                  Total Foods
                  </small>
                  <h3 class="fw-bold mb-0 text-primary">
                     {{ $myFood->total() }}
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
                  <i class="bi bi-code-slash fs-2"></i>
               </div>
               {{-- Text --}}
               <div>
                  <small class="text-muted d-block" style="font-size:18px;">
                    Total Type Of Foods
                  </small>
                  <h3 class="fw-bold mb-0 text-primary">
                     {{ $myFoodTypeTotal }}
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
                  <i class="bi bi-activity fs-2 "></i>
               </div>
               {{-- Text --}}
               <div>
                  <small class="text-muted d-block" style="font-size:18px;">
                  Available
                  </small>
                  <h3 class="fw-bold mb-0 text-primary">
                     {{ $available }}
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
                  <i class="bi bi-slack fs-2"></i>
               </div>
               {{-- Text --}}
               <div>
                  <small class="text-muted d-block" style="font-size:18px;">
                  Inavailable
                  </small>
                  <h3 class="fw-bold mb-0 text-primary">
                     {{ $inavailable  }}
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
        <form method="GET" action="{{ route('foods.index') }}">
            <div class="d-flex mb-3">
                <input type="text" name="search" class="form-control w-25" placeholder="Search foods here ...." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary ms-2"><i class="bi bi-search me-1"></i>Search</button>
            </div>
        </form>
         <div class="table-responsive"  id="customerTable">
            <table class="table align-middle" >
               <thead class="text-muted">
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Hotel</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th class="text-center">Actions</th>
                    </tr>
               </thead>
               <tbody>
                     @forelse ($myFood as $value)
                        <tr>
                            <td class="fw-semibold">{{ $value->name }}</td>
                            <td>{{ $value->foodCategory->name }}</td>
                            <td>{{ $value->hotel->name }}</td>
                            <td>${{ $value->price }}</td>
                            <td>{{ number_format($value->discount, 0) }}%</td>
                            <td>{{ $value->description }}</td>
                            <td class="text-center">
                                @if(($value->status) == 'available') 
                                    <div class="p-2 bg-success text-light w-75 text-center rounded-5"> Available </div>
                                @else
                                    <div class="p-2 bg-warning text-dark w-75 text-center rounded-5"> Inavailable </div>
                                @endif
                            </td>
                            <td>
                                @if($value->profile_photo)
                                    <img src="{{ asset('assets/uploads/Foods/'.$value->profile_photo) }}"
                                        width="45" height="45"
                                        style="border-radius:50%; object-fit:cover;">
                                    @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{('foods/').$value->id }}" class="btn btn-sm btn-primary me-1">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a href="{{ route('foods.edit',$value->id) }}" class="btn btn-sm btn-success me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                @if($value->status == 'available')
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
                            <td colspan="9" class="text-center text-light bg-danger">
                                No Data Found
                            </td>
                        </tr>
                     @endforelse
               </tbody>
            </table>
         </div>
         {{-- Pagination --}}
         <div class="d-flex justify-content-end mt-3">
           {{ $myFood->appends(request()->query())->links() }}
         </div>
      </div>
   </div>
</div>
{{-- ================================================================================================================== --}}
<!-- Add Food Modal -->
<div class="modal fade active" id="addUserModal" tabindex="-1">
   <div class="modal-dialog modal-lg">
      <div class="modal-content p-3">
         <!-- Header -->
         <div class="modal-header">
            <h5 class="modal-title">Add New Foods</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
         </div>
         <!-- Body -->
         <div class="modal-body">
            <form class="form" action="{{ route('foods.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="row">
                     <div class="col-md-6 col-12 mb-2">
                        <div class="form-group has-icon-left">
                            <label for="hotel_id">Choose Hotel</label>
                            <div class="position-relative">
                            <select class="form-control" id="hotel_id" name="hotel_id">
                                <option value="" disabled selected>Choose Hotel</option>
                                @foreach ($myHotel as $key => $value )  
                                 <option value="{{ $value->id }}"> {{ $value->name }} </option>
                                @endforeach
                            </select>
                            <div class="form-control-icon">
                               <i class="bi bi-door-open"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-6 col-12 mb-2">
                        <div class="form-group has-icon-left">
                            <label for="category_id">Choose Categoty Type</label>
                            <div class="position-relative">
                            <select class="form-control" id="category_id" name="category_id">
                                <option value="" disabled selected>Choose Categoty Type</option>
                                @foreach ($myCagegory as $key => $value )  
                                 <option value="{{ $value->id }}"> {{ $value->name }} </option>
                                @endforeach
                            </select>
                            <div class="form-control-icon">
                               <i class="bi bi-code-square"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <div class="form-group has-icon-left">
                            <label for="first-name-icon">Name</label>
                            <div class="position-relative">
                            <input type="text" class="form-control"
                                placeholder="Food Name here"
                                id="first-name-icon" name="name">
                            <div class="form-control-icon">
                                <i class="bi bi-egg-fill"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <div class="form-group has-icon-left">
                            <label for="Status">Discount</label>
                            <div class="position-relative">
                            <select class="form-control" id="discount" name="discount">
                                <option value="10">Discount 10%</option>
                                <option value="20">Discount 20%</option>
                                <option value="30">Discount 30%</option>
                                <option value="50">Discount 50%</option>
                            </select>
                            <div class="form-control-icon">
                                <i class="bi bi-tags"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <div class="form-group has-icon-left">
                            <label for="first-name-icon">Price</label>
                            <div class="position-relative">
                            <input type="text" class="form-control"
                                placeholder="Descript The Rooms"
                                id="first-name-icon" name="price">
                            <div class="form-control-icon">
                                <i class="bi bi-award"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <div class="form-group has-icon-left">
                            <label for="Status">Status</label>
                            <div class="position-relative">
                            <select class="form-control" id="status" name="status">
                                <option value="available">Available</option>
                                <option value="inavailable">Inavailable</option>
                            </select>
                            <div class="form-control-icon">
                                <i class="bi bi-radioactive"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-12 mb-2">
                        <div class="form-group has-icon-left">
                            <label for="first-name-icon">Description</label>
                            <div class="position-relative">
                            <input type="text" class="form-control"
                                placeholder="Descript The foods"
                                id="first-name-icon" name="description">
                            <div class="form-control-icon">
                                <i class="bi bi-amd"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-12 mb-4">
                        
                            <label for="fileUpload">Upload File</label>
                            <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                           
                    </div>
                    <div class="col-12 d-flex justify-content-end gap-2">
                        <a href="{{ route('foods.index') }}" type="reset"
                            class="btn btn-danger me-1 mb-1"><i class="bi bi-arrow-left-short me-1"></i>Back</a>
                        <button type="submit" class="btn btn-primary me-1 mb-1"><i class="bi bi-bookmark-heart me-1"></i>Save</button>
                    </div>
                </div>
            </form>
         </div>
      </div>
   </div>
</div>
{{-- ================================================ [ Modal Add Food Type ]  ================================================  --}}
<div class="modal fade active" id="addHotelModalImage" tabindex="-1">
   <div class="modal-dialog modal-lg">
      <div class="modal-content p-3">
         <!-- Header -->
         <div class="modal-header">
            <h5 class="modal-title">Add Food Type</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
         </div>
         <!-- Body -->
         <div class="modal-body">
            <form class="form" action="{{ route('foodCategory.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                     <div class="col-md-12 col-12 mb-2">
                        <div class="form-group has-icon-left">
                           <label for="Food Type">Food Type Here</label>
                           <div class="position-relative">
                              <input type="text" class="form-control"placeholder="Food Type Here" id="fname" name="name">
                              <div class="form-control-icon">
                                 <i class="bi bi-fork-knife"></i>
                              </div>
                           </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end gap-2">
                        <a href="{{ route('foods.index') }}" type="reset"
                            class="btn btn-danger me-1 mb-1"><i class="bi bi-arrow-left-short me-1"></i>Back</a>
                        <button type="submit" class="btn btn-primary me-1 mb-1"><i class="bi bi-bookmark-heart me-1"></i>Save</button>
                    </div>
                </div>
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
    
</script>
@endsection()