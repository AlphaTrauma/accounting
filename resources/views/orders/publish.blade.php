@extends('layouts.app')
@section('title') Файлы заказа и публикация @endsection
@section('content')
    <h1 class="text-center">Файлы заказа и публикация</h1>
     


    <div class="p-6 bg-white text-medium text-gray-500 rounded-lg w-full relative">
        <file-manager :id={{ $order->id }} entity="Order"></file-manager>
        <form action="{{ route('orders.update', $order) }}" method="POST"> 
            @csrf
            @method('PUT')
            @foreach($newStatus as $status => $label) 
                <input type="hidden" name="status" value="{{ $status }}">
                <input class="btn btn-active w-full" type="submit" value="{{ $label }}"> 
            @endforeach
        </form>

    </div>



    
    
@endsection