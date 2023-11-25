<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content=@yield('meta_keyword')>
    <meta name="author" content="Manish Walia Blog">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- Styles --}}
    <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" />
    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <style>
        body{
            /* background-color: red; */
        }
    </style>
</head>
<body>
    <div id="app">
        @include('layouts.inc.frontend-navbar')

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
