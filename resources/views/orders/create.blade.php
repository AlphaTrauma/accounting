@extends('layouts.app')
@section('title') Создание нового заказа @endsection
@section('content')
    <h1 class="text-center">Создать новый заказ</h1>
     


    <div class="p-6 bg-white text-medium text-gray-500 rounded-lg w-full relative">
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="my-5">
                <x-text-input id="title" required="1" label="Заголовок"></x-text-input>
                
                
            </div>
            <div class="my-5 flex gap-5">
                <x-number-input id="sum" label="Сумма заказа (₽)"></x-sum-input>
                <x-date-input id="date_to" label="Дедлайн"></x-date-input>
            </div>
            <input type="hidden" name="user_id" value="{{ \Auth::id() }}">
            <div class="my-5">
                <textarea name="description" id="description" rows="4" class="textarea" placeholder="Введите описание заказа"></textarea>
            
            </div>
            <input class="btn btn-active w-full" value="Продолжить" type="submit"></button>
        </form>

    </div>



    
    
@endsection