@extends('layouts.app')

@section('content')
    <h1 class="text-center">Личный кабинет пользователя <span class="text-cyan-600">{{ Auth::user()->email }}</span></h1>
    <x-alert></x-alert>

<div class="md:flex">
    @include('LK.nav')
    <div class="p-6 bg-gray-50 text-medium text-gray-500 rounded-lg w-full">
        <h3 class="text-lg font-bold text-gray-900 mb-2 text-center">Размещённые заказы</h3>
        
        <ul class="flex flex-wrap text-lg text-center text-gray-500 border-b my-5">
            @foreach($statuses as $status => $label)
                 @if($status === $active)
                      <li class="me-2">
                          <div class="inline-block p-4 border-b-2 border-teal-600 rounded-t-lg">{{ $label }}</div>
                      </li>
                 @else
                      <li class="me-2">
                          <a href="?status={{ $status }}" aria-current="page" 
                          class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">{{ $label }}</a>
                      </li>
                 @endif 
            @endforeach
        </ul>



        
 
        @forelse($orders as $order)
            @include('blocks.manage_order', ['order' => $order])
        @empty
        <p class="text-lg mb-3">
            У вас нет заказов в выбранном статусе
        </p>
        @endforelse
        
    </div>
</div>


    
    
@endsection