@extends('layouts.app')

@section('content')
    <div class="relative">
        @include('blocks.order_customer', ['user' => $order->user])
        <h1>Заказ № {{ $order->id }}</h1>
        <h2 class="text-2xl font-bold">{{ $order->title }}</h2>
        <div class="my-5">
            {{ $order->description }}
        </div>
        <div class="my-5">
            <ul class="space-y-4 text-left">
                <li>
                    <span class="font-bold">Сложность:</span> <span>Средняя</span>
                </li>
                <li>
                    <span class="font-bold">Дедлайн:</span> <span>{{ $order->date_to->format('d.m.Y') }} ({{ $order->date_to->diffForHumans() }})</span>
                </li>
                <li>
                    <span class="font-bold">Вложения:</span> <span>{{ $order->files_count }}</span>
                </li>
            </ul>
        </div>
        <div class="absolute flex gap-3 items-center right-0 bottom-0 bg-teal-50 p-5 text-2xl text-teal-600 font-bold">
            @if(Auth::user()->executor) {{-- and Auth::id() !== $order->user_id) --}}
            @if($hasResponse)
            <div>
                <form method="POST" action="{{ route('response.remove' )}}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <input type="submit" value="Отозвать отклик" class="btn btn-primary"> 
                </form>
                
            </div>
            @else

            <div>
                <request-form text="Вы уверены, что хотите отправить отклик на этот заказ?" action="{{ route('response.send' )}}">
                    @csrf
                    <input type="hidden" name="order_user_id" value="{{ $order->user_id }}">
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <input type="submit" value="Оставить отклик" class="btn btn-active"> 
                </request-form>
                
            </div>
            @endif
            @endif
            <div>
                {{ $order->responses_count }} откликов
            </div>
        </div>
        
    </div>
    
    


    
    
@endsection