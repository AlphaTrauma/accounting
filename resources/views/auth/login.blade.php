@extends('layouts.app')

@section('content')



    <div class="max-w-md mx-auto">
        <h1 class="text-center">Вход</h1>
        <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email Address -->
        <div>
            <x-text-input label="Введите email" id="email"></x-text-input> 
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4"> 

            <x-text-input label="Введите пароль" id="password"></x-text-input> 

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-md text-gray-600">Запомнить меня</span>
            </label>
        </div>
        <div class="flex items-center justify-between mt-5 gap-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    Забыли пароль?
                </a>
            @endif

                <button class="btn btn-active">Войти</button>
        </div>
    </form>
    </div>
@endsection
