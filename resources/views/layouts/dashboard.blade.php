<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель управления</title> 
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="title" content="@yield('title')">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100" id="app">
<div class="min-h-screen flex flex-col">
    <nav class="bg-teal-600 p-4">
        <div class="mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="block py-2 px-4 text-white hover:opacity-70 flex gap-4 items-center">
                <i class="fa-solid fa-house"></i>

                <span>На сайт</span>
            </a>
            <div class="flex">
                <a href="#" class="px-4  text-white">{{ Auth::user()->name }}</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-4 text-white font-bold">Выйти</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="flex flex-1">
        <!-- Sidebar -->
        @include('dashboard.sidebar')

        <!-- Main Content -->
        <main class="p-6 w-full">
            <x-alert></x-alert>
            @yield('content')
        </main>
    </div>
</div>
@include('blocks.svg')
</body>
</html>
