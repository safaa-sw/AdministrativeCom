<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<!-- CoreUI and necessary plugins-->
<script src="{{asset('template/vendors/@coreui/coreui/js/coreui.bundle.min.js')}}"></script>
<script src="{{asset('template/vendors/simplebar/js/simplebar.min.js')}}"></script>
<!-- Plugins and scripts required by this view-->
<script src="{{asset('template/vendors/chart.js/js/chart.min.js')}}"></script>
<script src="{{asset('template/vendors/@coreui/chartjs/js/coreui-chartjs.js')}}"></script>
<script src="{{asset('template/vendors/@coreui/utils/js/coreui-utils.js')}}"></script>
<script src="{{asset('template/js/main.js')}}"></script>


<!-- Include the plugin's CSS and JS: -->
<script type="text/javascript" src="{{ asset('template/js/bootstrap-multiselect.js') }}"></script>


@yield('javascript')