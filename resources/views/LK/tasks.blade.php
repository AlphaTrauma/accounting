@extends('layouts.app')

@section('content') 
    <h1 class="text-center">Личный кабинет пользователя <span class="text-cyan-600">{{ Auth::user()->email }}</span></h1>
     <x-alert></x-alert>

<div class="md:flex">
    @include('LK.nav')
    <div class="p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg w-full">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 text-center">Взятые заказы</h3>
        @forelse($tasks as $task)
            <div class="flex justify-between items-center border-b border-slate-200 py-3 px-2 border-l-4
            border-l-transparent bg-gradient-to-r to-slate-200 from-transparent mb-2 text-lg">
                <div class="space-x-2"> 
                    <a class="link" href="{{ route('orders.show', $task) }}">{{ $task->title }}</a>
                </div> 
                <div class="flex gap-2">
                
                    <a href="{{ route('orders.fulfillment', $task)}}" title="К выполнению заказа" class="btn btn-sm btn-active">
                        К выполнению заказа
                    </a>
                    
                </div> 
            </div>
        @empty

        @endforelse
    </div>
</div>


    
    
@endsection