@extends('layouts.app')
@section('title') Личный кабинет пользователя @endsection
@section('content') 
    
<h1 class="text-center">Личный кабинет пользователя <span class="text-cyan-600">{{ Auth::user()->email }}</span></h1>
     
<x-alert></x-alert>

<div class="md:flex">
    @include('LK.nav')
    <div class="p-6 bg-gray-50 text-medium text-gray-500 rounded-lg w-full">
        <h3 class="text-lg font-bold text-gray-900 mb-2 text-center">Приобретённые гайды</h3>
        


        
 
        @forelse($purchases as $purchase)
            @if($purchase->guide)
            <div class="p-3  bg-white border mb-4">
                <h3 class=" font-bold text-center">{{ $purchase->guide->title }}</h3>
                <p>{{ $purchase->guide->description }}</p>
                <div class="my-2">
                    @foreach($purchase->guide->files as $file)
                        <div class="w-full p-1 relative rounded-sm flex gap-3 items-center">
                            <div class="relative">
                                <svg width="30" height="30">
                                    <use href="#{{ $file->icon }}"></use>
                                </svg>
                            </div>
                            <a href="{{ route('download', $file->id) }}" title="Скачать файл" class="text-lg p-1 cursor-pointer hover:underline flex items-center gap-3">
                                <span>{{ $file->filename }}</span> <i class="fa-solid fa-arrow-down-long"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        
        @empty
        <p class="text-lg mb-3">
            У вас нет купленных гайдов
        </p>
        @endforelse
        
    </div>
</div>


    
    
@endsection