<!DOCTYPE html>
<html lang="{{  app()->getLocale() }}" @if ((app()->getLocale())=='ar') dir="rtl" @else dir="ltr"@endif>

<head>
    @include('admin.layouts.head')
</head>

<body>
    @include('sweetalert::alert')
    @include('admin.layouts.sidebar')

    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        @include('admin.layouts.header')

        @yield('content')

        <br />
        <br />
        <br />


        @include('admin.layouts.footer')
    </div>

    @include('admin.layouts.javascripts')
</body>

</html>
