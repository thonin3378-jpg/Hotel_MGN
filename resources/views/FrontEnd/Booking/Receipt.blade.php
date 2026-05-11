@extends('FrontEnd.Home.master')
@section('content')
@section('Booking','active')


        <!-- Booking Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">Thank you for your booking</h6>
                    <h1 class="mb-5">Your<span class="text-primary text-uppercase"> Booking</span></h1>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <table class="table table-striped table-bordered align-middle mb-0">
                                <thead class="table-dark text-center">
                                    <tr>
                                        <th>Name</th>
                                        <th>Check In</th>
                                        <th>Check Out</th>
                                        <th>Room</th>
                                        <th>Payment Method</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>

                                <tbody class="text-center">
                                    @if(isset($booking) && count($booking))
                                        @foreach($booking as $item)
                                            <tr>
                                                <td>{{ $item->customer->name ?? '' }}</td>
                                                <td>{{ $item->check_in }}</td>
                                                <td>{{ $item->check_out }}</td>
                                                <td>{{ $item->room->name ?? '' }}</td>
                                                <td>{{ $item->payment_method }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5">No bookings found</td>
                                        </tr>
                                    @endif

                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Booking End -->


        <!-- Newsletter Start -->
        <div class="container newsletter mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="row justify-content-center">
                <div class="col-lg-10 border rounded p-1">
                    <div class="border rounded text-center p-1">
                        <div class="bg-white rounded text-center p-5">
                            <h4 class="mb-4">Tnank for Subscribe Our <span class="text-primary text-uppercase">Service</span></h4>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Newsletter Start -->

@endsection