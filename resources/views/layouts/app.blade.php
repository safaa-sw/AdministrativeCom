<!DOCTYPE html>
<html lang="{{  app()->getLocale() }}" @if ((app()->getLocale())=='ar') dir="rtl" @else dir="ltr"@endif>
   

<head>
      
    @include('layouts.head')

</head>

<body>
    @include('sweetalert::alert')
    @include('layouts.sidebar')

    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        @include('layouts.header')

        @yield('content')

        <br />
        <br />
        <br />


        @include('layouts.footer')
    </div>

    @include('layouts.javascripts')
</body>

</html>
