@extends('layouts.app')

@section('content') 
    <h1 class="text-center">Личный кабинет пользователя <span class="text-cyan-600">{{ Auth::user()->email }}</span></h1>
     <x-alert></x-alert>

<div class="md:flex">
    @include('LK.nav')
    <div class="p-6 bg-gray-50 text-medium text-gray-500 rounded-lg w-full">
        <h3 class="text-lg font-bold text-gray-900 mb-2 text-center">Отправленные отклики</h3>
         
  
 
        @forelse($responses as $response)
            <div class="flex justify-between items-center border-b border-slate-200 py-3 px-2 border-l-4
                        border-l-transparent bg-gradient-to-r to-slate-200 from-transparent mb-2 text-lg">
            <div class="space-x-2"> 
                <a class="link" href="{{ route('orders.show', $response->order) }}">{{ $response->order->title }}</a>
            </div> 
            <div class="flex gap-2">
                <request-form text="Вы уверены, что хотите отозвать отклик?" action="{{ route('response.remove', $response) }}">
                    @method('DELETE')
                    @csrf
                    <button title="Удалить" type="submit" class="btn btn-sm bg-white">
                        <i class="fa fa-trash"></i>
                    </button>
                </request-form>
                
            </div> 
        </div>
        @empty
        <p class="text-lg mb-3">
            У вас нет отправленных откликов
        </p>
        @endforelse
        
    </div>
</div>


    
    
@endsection