@extends('layouts.app')
@section('title') Личный кабинет пользователя @endsection
@section('content')
    <h1 class="text-center">Личный кабинет пользователя <span class="text-cyan-600">{{ Auth::user()->email }}</span></h1>
     <x-alert></x-alert>

<div class="md:flex">
    @include('LK.nav')
    <div class="p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg w-full">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 text-center">Профиль заказчика</h3>
        <form class="max-w-[700px]" method="POST" action="{{ route("lk.customer.update") }}">
            @csrf
            <div class="my-4"> 
                <x-text-input label="Фамилия" id="last_name" value="{{ Auth::user()->customer->last_name }}"></x-text-input>
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>
            <div class="my-4"> 
                <x-text-input label="Профессия или специализация" id="job_title" value="{{ Auth::user()->customer->job_title }}"></x-text-input>
                <x-input-error :messages="$errors->get('job_title')" class="mt-2" />
            </div>
            <div class="my-4"> 
                <x-text-input label="Что-то ещё" id="direction" value="{{ Auth::user()->customer->direction }}"></x-text-input>
                <x-input-error :messages="$errors->get('direction')" class="mt-2" />
            </div>
            

            <input type="submit" class="btn btn-active" value="Сохранить">
        </form>
    </div>
</div>


    
    
@endsection