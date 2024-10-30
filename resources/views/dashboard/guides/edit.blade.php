@extends('layouts.dashboard')

@section('content')
    <h1 class="text-center">Редактирование гайда</h1>
     


    <div class="p-6 bg-white text-medium text-gray-500 rounded-lg w-full relative">
         
        <form action="{{ route('guides.update', $guide) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="my-5">
                <x-text-input id="title" value="{{ $guide->title }}" required="1" label="Заголовок"></x-text-input>
            </div> 
            <div class="my-5 flex gap-5">
                <x-number-input id="price" value="{{ $guide->price }}" label="Цена"></x-sum-input>
            </div>
            <div class="my-5">
                <textarea id="description" name="description" rows="4" class="textarea" placeholder="Описание гайда">{{ $guide->description }}</textarea>
            </div>
            <file-manager :id={{ $guide->id }} entity="Guide"></file-manager>
            <button class="btn btn-active w-full" type="submit">Продолжить</button>
        </form>

    </div>



    
    
@endsection