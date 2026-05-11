            <footer class="mt-3 p-3 myfooter">
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2026 &copy; B.S HOTEL</p>
                    </div>
                    <div class="float-end me-3 text-center">
                        <p>Created <span class="text-danger"><i class="bi bi-heart"></i></span> by <a href="#">Nh->nin</a></p>
                    </div>
                </div>
            </footer>
            <style>
                .myfooter{
                    background-color: rgba(181, 181, 181, 0.689);
                }
            </style>
        </div>
    </div>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>

    <!-- Dark mode MUST come before main.js -->
    <script src="{{ asset('assets/js/initTheme.js') }}"></script>
    <script src="{{ asset('assets/js/dark.js') }}"></script>
    <script src="{{ asset('assets/js/theme-toggle.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!-- Bootstrap Icons (CSS only, in head is better) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<!-- SweetAlert2 toast -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(Session::has('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ Session::get('success') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        @endif
        @if(Session::has('updateSuccess'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ Session::get('updateSuccess') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        @endif
        @if(Session::has('deleteSuccess'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ Session::get('deleteSuccess') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        @endif
        @if(Session::has('error'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ Session::get('error') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        @endif
    });
</script>
{{-- @yield('add-select2-script') --}}
{{-- --------------------------------------------------------------- --}}
  <script src="{{asset('backend_assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
  <script src="{{asset('backend_assets/plugins/jquery-validation/additional-methods.min.js')}}"></script>
{{-- --------------------------------------------------------------- --}}

<!-- Initialize AOS -->
<script>
    AOS.init();
</script>

    
    
    
</body>

</html>