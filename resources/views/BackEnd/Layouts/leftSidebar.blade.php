@section('Setting-Detail','active submenu-open')
{{-- @section('Hotels-Settings','active submenu-open') --}}
@section('Setting-Privatecy','active')
@section('Setting-Detail','active')

<div id="sidebar" class="active sidebarZin">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="{{ route('dashboard.index') }}"><img src="{{ asset('assets/images/logo/mylogo.png') }}" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="{{ route('dashboard.index') }}" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title @yield('dashboard')">Menu</li>
                        <li class="sidebar-item  @yield('dashboard') ">
                            <a href="{{ route('dashboard.index') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-title active has-sub "><b>Setting & Privatecy</b></li>
                        <li class="sidebar-item @yield('Setting-Detail') has-sub">
                            <a href="#" class='sidebar-link @yield('Setting-Privatecy')'>
                                <i class="bi bi-gear-fill me-1 mb-2"></i> 
                                <span >User Management</span>
                            </a>
                            {{-- active submenu-open --}}
                            <ul class="submenu @yield('Setting-Detail')">
                                <li class="submenu-item @yield('staffs')">
                                    <a href="{{ route('staffs.index') }}"> <i class="bi bi-person-hearts"></i> Staffs</a>
                                </li>
                                <li class="submenu-item @yield('customers')">
                                    <a href="{{ route('customers.index') }}"> <i class="bi bi-person-arms-up"></i> Customers</a>
                                </li>
                                <li class="submenu-item @yield('users')">
                                    <a href="{{ route('users.index') }}"><i class="bi bi-person-fill"></i> Users</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-title"><b>Hotels & Privatecy</b></li>
                        <li class="sidebar-item  @yield('Hotels-Settings') has-sub">
                            <a href="#" class='sidebar-link Hotels @yield('Hotels')'>
                                <i class="bi bi-door-open-fill"></i>
                                <span>Hotels Settings</span>
                            </a>
                            <ul class="submenu @yield('Hotels-Settings')">
                                <li class="submenu-item @yield('Hotel')" >
                                    <a href="{{ route('hotels.index') }}"><i class="bi bi-hospital"></i> Hotel</a>
                                </li>
                                <li class="submenu-item @yield('services')">
                                    <a href="{{ route('services.index') }}"><i class="bi bi-slack"></i> Services</a>
                                </li>
                                <li class="submenu-item @yield('Rooms-Type')">
                                    <a href="{{ route('RoomTypes.index') }}"><i class="bi bi-houses"></i> Rooms Type</a>
                                </li>
                                <li class="submenu-item @yield('Rooms')">
                                    <a href="{{ route('rooms.index') }}"><i class="bi bi-house-door"></i> Rooms</a>
                                </li>
                                
                                {{-- <li class="submenu-item">
                                    <a href="#"><i class="bi bi-door-open-fill"></i> Home and Hotels</a>
                                </li> --}}
                                
                            </ul>
                        </li>
                        <li class="sidebar-title"><b>Resturant</b></li>
                        <li class="sidebar-item  has-sub @yield('Foods-Settings')">
                            <a href="#" class='sidebar-link @yield('Foods-Settings')'>
                                <i class="bi bi-fork-knife"></i>
                                <span>Food Setting</span>
                            </a>
                            <ul class="submenu @yield('Foods-Settings')">
                                <li class="submenu-item @yield('Foods')">
                                    <a href="{{ route('foods.index') }}"><i class="bi bi-cup-straw"></i> Food & Drink</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-title"><b>Booking</b></li>
                        <li class="sidebar-item  has-sub  @yield('Booking-Settings')">
                            <a href="#" class='sidebar-link @yield('Booking-Settings') '>
                                <i class="bi bi-send-plus"></i>
                                <span>Booking Details</span>
                            </a>
                            <ul class="submenu @yield('Booking')">
                                <li class="submenu-item ">
                                    <a href="{{ route('bookingList.index') }}"><i class="bi bi-journal-plus"></i> Booking</a>
                                </li>
                                {{-- <li class="submenu-item ">
                                    <a href="#">Booking Detail</a>
                                </li> --}}
                                {{-- <li class="submenu-item ">
                                    <a href="#">Update Room</a>
                                </li> --}}
                            </ul>
                        </li>
                        <li class="sidebar-title"><b>Others</b></li>
                        {{-- ========================================================================== --}}
                        
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Active Status</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="{{ route('logout') }}"> <i class="bi bi-door-closed me-1"></i> Logout</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="{{ route('home.index') }}"> <i class="bi bi-box-arrow-right me-1"></i> Back Front</a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="sidebar-item has-sub">
                            <a href="#" class="sidebar-link">
                                <i class="bi bi-moon"></i>
                                <span>Dark Mode</span>
                            </a>

                            <ul class="submenu">
                                <li class="submenu-item">
                                    <a href="#" id="dark-on"> <i class="bi bi-lightbulb-off me-1"></i> Turn On</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="#" id="dark-off"> <i class="bi bi-lightbulb me-1"></i> Turn Off</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>

<style>
    .sidebar-wrapper{
        box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
    }
</style>