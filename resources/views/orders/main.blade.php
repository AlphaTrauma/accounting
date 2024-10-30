@extends('layouts.app')

@section('content')
    <h1 class="text-center">Доступные заказы</h1>
     
    <div class="my-5">
        <div class="w-full">
            <x-text-input label="Поиск"></x-text-input>
        </div>
    </div>
    <div class="my-5 flex gap-3">
        <div class=" max-w-1/2 w-full">
            <select class="select">
                <option selected>Последние размещённые</option>
                <option value="">Высокооплачиваемые</option>
                <option value="">С большим сроком выполнения</option>
                <option value="">С высокой оценкой заказчика</option>
            </select>
        </div>
        <div class=" max-w-1/2 w-full">
            <select class="select">
                <option selected>По типу задания (навыку)</option> 
            </select>
        </div>
        
    </div>
    <div class="flex gap-3 py-5">
        @foreach($orders as $order)
            @include('orders.order_block')
        @endforeach
    </div>
    


    
    
@endsection