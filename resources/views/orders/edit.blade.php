@extends('layouts.app')

@section('content')
    <h1 class="text-center">Редактирование заказа</h1>
     


    <div class="p-6 bg-white text-medium text-gray-500 rounded-lg w-full relative">
         
        <form action="{{ route('orders.update', $order) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="my-5">
                <x-text-input id="title" value="{{ $order->title }}" required="1" label="Заголовок"></x-text-input>
            </div> 
            <div class="my-5 flex gap-5">
                <x-number-input id="sum" value="{{ $order->sum }}" label="Сумма заказа (₽)"></x-sum-input>
                <x-date-input id="date_to" value="{{ $order->date_to ? $order->date_to->format('Y-m-d') : '' }}" label="Дедлайн"></x-date-input>
            </div>
            <div class="my-5">
                <textarea id="description" name="description" rows="4" class="textarea" placeholder="Введите описание заказа">{{ $order->description }}</textarea>
            </div>
            
            <button class="btn btn-active w-full" type="submit">Продолжить</button>
        </form>

    </div>



    
    
@endsection