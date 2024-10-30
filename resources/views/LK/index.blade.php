@extends('layouts.app')

@section('content') 
    <h1 class="text-center">Личный кабинет пользователя <span class="text-cyan-600">{{ Auth::user()->email }}</span></h1>
     

<div class="md:flex">
    @include('LK.nav')
    <div class="p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg w-full relative">
        <h3 class="text-lg font-bold text-gray-900 mb-2">Основная информация</h3>
        <div class="my-5 ">
            <div class="flex gap-3 mb-5">
                @if(Auth::user()->executor and false)
                <div>
                    <p class="text-lg mb-3">Ваша оценка исполнителя: </p>
                     <x-rating rating="7"></x-rating>
                </div>
                @endif
                @if(Auth::user()->customer)
                <div>
                    <p class="text-lg mb-3">Ваша оценка заказчика: </p>
                     <x-rating rating="7"></x-rating>
                </div>
                @endif
            </div>
            <p class="text-lg mb-3">
                Последний заказ:
            </p>
            @if($lastOrder)
                @include('blocks.manage_order', ['order' => $lastOrder])
            @endif
            <request-form action="{{ route('logout') }}" text="Вы уверены, что хотите выйти из своего аккаунта?" class="absolute bottom-3 right-3">
                @csrf
                <button type="submit" class="px-4 text-red-600 underline font-bold">Выйти</button>
            </request-form>
        </div>
    </div>
</div>


    
    
@endsection