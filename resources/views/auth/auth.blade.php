<!doctype html>
<html lang="{{ app()->getLocale() }}" @if (app()->getLocale() == 'ar') dir="rtl" @else dir="ltr" @endif>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ __('homePage.appTitle') }}</title>
    <!-- Vendors styles-->
    <link rel="stylesheet" href="{{ asset('template/vendors/simplebar/css/simplebar.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/vendors/simplebar.css') }}">
    <!-- Main styles for this application-->
    <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
    <link href="{{ asset('template/css/examples.css') }}" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>

    <link href="{{ asset('template/vendors/@coreui/chartjs/css/coreui-chartjs.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('template/css/bootstrap-multiselect.css') }}" type="text/css" />

    <link href="{{ asset('favicon.svg') }}" rel="icon">

</head>

<body>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
       <div>
        <br/>
        <br/>
        <br/>
       </div>

        @yield('content')

    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('template/vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('template/vendors/simplebar/js/simplebar.min.js') }}"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="{{ asset('template/vendors/chart.js/js/chart.min.js') }}"></script>
    <script src="{{ asset('template/vendors/@coreui/chartjs/js/coreui-chartjs.js') }}"></script>
    <script src="{{ asset('template/vendors/@coreui/utils/js/coreui-utils.js') }}"></script>
    <script src="{{ asset('template/js/main.js') }}"></script>
    @yield('javascript')
</body>

</html>
