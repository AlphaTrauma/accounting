@extends('layouts.app')

@section('head')
    <title>Бухгалтерские гайды, шаблоны документов | СчётКоннект — биржа бухгалтерских услуг</title>
    <meta name="description" content="Купить бухгалтерские гайды, шаблоны документов на бирже бухгалтерских услуг">
@endsection

@section('content')
    <div class="py-6 bg-white">
        <div class="p-3">
            <h1>Гайды</h1>
        </div>
        <div class="flex gap-3">
            @foreach($guides as $guide)
            <div  class="block w-full max-w-[33%] p-6 pb-[80px] rounded-lg relative shadow  bg-gray-200">
                
                <h5 class="mb-2 text-2xl font-bold">{{ $guide->title }}</h5>
                <p class="font-normal text-gray-700">{{ $guide->description }}</p>
                <hr class="my-5">
                <div class="flex justify-between items-center absolute bottom-5 left-5 right-5 ">
                    
                    <div>
                        @if(in_array($guide->id, $purchased))
                            <a href="{{ route('lk.purchases') }}" class="btn btn-secondary">Куплено</a>
                        @else
                            <a href="{{ route('purchase', $guide) }}" class="btn btn-active">Купить</a>
                        @endif
                        
                    </div>
                    <div>
                        <div><b>Вложений:</b> {{ $guide->files_count }}</div>
                        <div><span class=" text-teal-600 font-bold"><span class="text-2xl">{{ number_format($guide->price, 0, '', ' ') }}</span> ₽</span>   </div>
                    </div>
                </div>
        </div>
            @endforeach
        </div>
        
    </div>
@endsection