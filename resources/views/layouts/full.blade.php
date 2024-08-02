<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        
        @yield('head')
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="min-h-screen" id="app">
            @include('navigation.navbar')

            <div class="py-5 w-full mx-auto">
                @yield('content')
            </div>
        </div>
        @include('footer')
    </body>
</html>
