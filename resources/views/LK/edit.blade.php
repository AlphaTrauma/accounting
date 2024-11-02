@extends('layouts.app')
@section('title') Личный кабинет пользователя @endsection
@section('content') 
    <h1 class="text-center">Личный кабинет пользователя <span class="text-cyan-600">{{ Auth::user()->email }}</span></h1>
     <x-alert></x-alert>

<div class="md:flex">
    @include('LK.nav')
    <div class="p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg w-full ">
        <h3 class="text-lg font-bold text-gray-900 text-center mb-2">Редактирование данных пользователя</h3>
        <form class="max-w-[700px]" method="POST" action="{{ route("lk.user.update") }}">
            @csrf
            <div class="my-4"> 
                <x-text-input label="Имя" id="name" value="{{ Auth::user()->name }}"></x-text-input>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="my-4"> 
                <x-text-input label="E-mail" id="email" value="{{ Auth::user()->email }}"></x-text-input>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            
            <h2 class="font-bold text-lg text-center">
                Смена пароля
            </h2>
            <div class="flex gap-3">
                <div class="my-4"> 
                    <x-text-input label="Новый пароль" id="password"></x-text-input> 
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                 
                <div class="my-4"> 
                    <x-text-input label="Подтвердите пароль" id="password_confirmation"></x-text-input>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>
            

            <input type="submit" class="btn btn-active" value="Сохранить">
        </form>
    </div>
</div>


    
    
@endsection


