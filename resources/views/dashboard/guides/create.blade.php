@extends('layouts.dashboard')

@section('content')
    <h1 class="text-center">Создать новый гайд</h1>
     


    <div class="p-6 bg-white text-medium text-gray-500 rounded-lg w-full relative">
        <form action="{{ route('guides.store') }}" method="POST">
            @method('PUT')
            @csrf
            <div class="my-5">
                <x-text-input id="title" required="1" label="Заголовок"></x-text-input> 
            </div>
            <div class="my-5 flex gap-5">
                <x-number-input id="price" label="Цена"></x-sum-input> 
            </div> 
            <div class="my-5">
                <textarea name="description" id="description" rows="4" class="textarea" placeholder="Описание гайда"></textarea>
            
            </div>
            <input class="btn btn-active w-full" value="Продолжить" type="submit"></button>
        </form>

    </div>



    
    
@endsection