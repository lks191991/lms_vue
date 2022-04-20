<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->

    
    <!-- Styles -->
   
    <link rel="stylesheet" href="{{ asset('/front/dist/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('/front/dist/custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('/front/dist/responsive.css') }}" />
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

</head>
<body style="background-color: #ebebf2;">
    <div id="app">
        @if(isset(auth()->user()->id))
         @include('layouts.header-inner')
        @else
        @include('layouts.header')
        @endif
         <router-view></router-view>
        
        @include('layouts.footer')
    </div>
    @auth
<script>
    window.user = @json(auth()->user())
</script>
@endauth
<script src="{{ mix('/js/app.js') }}"></script>
    <script src="{{ asset('/front/src/scss/vendors/plugin/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{ asset('/front/src/scss/vendors/plugin/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ asset('/front/src/scss/vendors/plugin/js/slick.min.js')}}"></script>
    <script src="{{ asset('/front/src/scss/vendors/plugin/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{ asset('/front/src/js/app.js')}}"></script>
    <script src="{{ asset('/front/dist/main.js')}}"></script>
    <script>
        $(".play-button").magnificPopup({
            type: "iframe",
        });
    </script>
</body>
</html>
