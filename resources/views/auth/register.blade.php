@extends('layouts.app')

@section('content')

    <div class="max-w-md mx-auto">
        <h1>Регистрация</h1>
        <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
            <div>
                <label class="block font-medium text-sm text-gray-700" for="name">Имя</label>
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <label class="block font-medium text-sm text-gray-700" for="email">E-mail</label>
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label class="block font-medium text-sm text-gray-700" for="password">Пароль</label>

                <x-text-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label class="block font-medium text-sm text-gray-700" for="password_confirmation">Подтвердите пароль</label>
                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                              type="password"
                              name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4 gap-4">
                <a class="link" href="{{ route('login') }}">
                    Уже зарегистрированы?
                </a>

                <button class="btn btn-active">Зарегистрироваться</button>
            </div>
        </form>
    </div>


@endsection
