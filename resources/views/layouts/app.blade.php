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
    <body class="max-w-[100vw] overflow-x-hidden">
        <div class="min-h-[80vh] bg-gray-100" id="app">
            @include('navigation.navbar')
            @include('navigation.mobile')
            @hasSection('wide-content')
            <main>
                @yield('wide-content')
            </main>
            @else
            <div class="pt-[120px] py-5">
                <main class="py-5 px-4 max-w-screen-xl mx-auto  bg-white">
                    @yield('content')
                </main>
            </div>
            @endif
            
        </div>
        @include('footer')
        <script>
            window.addEventListener("load", (event) => { 
                const navbar = document.getElementById('navbar');
                if (window.scrollY > 3) {
                        navbar.classList.add('bg-white', 'shadow-md');
                        navbar.classList.remove('bg-transparent', 'py-2'); 
                    } else {
                        navbar.classList.remove('bg-white', 'shadow-md');
                        navbar.classList.add('bg-transparent', 'py-2');
                    }
                document.addEventListener('scroll', function() {
                
                    if (window.scrollY > 3) {
                        navbar.classList.add('bg-white', 'shadow-md');
                        navbar.classList.remove('bg-transparent', 'py-2'); 
                    } else {
                        navbar.classList.remove('bg-white', 'shadow-md');
                        navbar.classList.add('bg-transparent', 'py-2');
                    }
                });
                const burgerBtn = document.getElementById('burger'), burgerCls = document.getElementById('burger-close'), mobileMenu = document.getElementById('mobile-menu'),
                body = document.querySelector('body');
                burgerBtn.onclick = () => { 
                    mobileMenu.classList.replace('-translate-x-full', '-translate-x-0');
                    body.style.overflowY = "hidden";
                }
                burgerCls.onclick = () => { 
                    mobileMenu.classList.replace( '-translate-x-0', '-translate-x-full' );
                    body.style.overflowY = 'auto';
                }
            }); 
             
        </script>
        <script src="https://kit.fontawesome.com/e96bfdb519.js" crossorigin="anonymous"></script>
    </body>
</html>
