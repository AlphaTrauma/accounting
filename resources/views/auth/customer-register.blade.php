@extends('layouts.app')

@section('content')

    <div class="max-w-md mx-auto">
        <h1 class=" text-center mb-[100px]">Регистрация заказчика</h1>
        <form method="POST" action="{{ route('customer_store') }}">
        @csrf

            <!-- Name -->
            <div>
                <x-text-input required="true" label="Имя" id="name"></x-text-input> 
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4"> 
                <x-text-input required="true" label="Введите email" id="email"></x-text-input> 
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4"> 
                <x-text-input required="true" label="Пароль" id="password"></x-text-input>

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4"> 
                <x-text-input required="true" label="Подтвердите пароль" id="password_confirmation"></x-text-input>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <h2 class="text-lg font-bold text-center">
                Данные заказчика
            </h2>

            <div>
                <x-text-input required="false" label="Фамилия" id="last_name"></x-text-input> 
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>

            <div>
                <x-text-input required="false" label="Должность или специальность" id="job_title"></x-text-input> 
                <x-input-error :messages="$errors->get('job_title')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between my-5 gap-4">
                <a class="link" href="{{ route('login') }}">
                    Уже зарегистрированы?
                </a>

                <button class="btn btn-active">Зарегистрироваться</button>
            </div>
        </form>
    </div>


@endsection
