@extends('layouts.app')

@section('content')
    <div class="relative">
        @include('blocks.order_customer', ['user' => $order->user])
        <h1>Выполнение заказа № {{ $order->id }}</h1> 
        <div class="my-5">
            {{ $order->description }}
        </div>
        <div class="my-5">
            @if($order->date_to > date('Y-m-d H:i:s'))
                <div class="text-teal-700 font-bold text-2xl">Дедлайн {{ $order->date_to->diffForHumans() }}</div>
            @else
                <div class="text-red-700 font-bold text-2xl">
                    Заказ просрочен на {{ $order->date_to->diffForHumans() }}
                </div>
            @endif
        </div>
        <div class="py-3">
            Файлы заказа:
        </div>
        <div class="flex gap-3 mb-3">
            @foreach($order->files as $file)
                <div class="py-2 px-4 relative rounded-sm bg-gray-100 flex gap-3 items-center">
                    <div class="relative">
                        <svg width="30" height="30">
                            <use href="#{{ $file->icon }}"></use>
                        </svg>
                    </div>
                    <a href="{{ route('orders.download', $file->id) }}" title="Скачать файл" class="text-lg p-1 cursor-pointer hover:underline flex items-center gap-3">
                        <span>{{ $file->filename }}</span> <i class="fa-solid fa-arrow-down-long"></i>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="flex gap-3">
            
            <div class="basis-1/2 border p-2">
                <h3 class="font-bold my-3 text-center">Чат</h3>
                @include('blocks.chat')
            </div>
            <div class="basis-1/2 border p-2">
                <h3 class="font-bold my-3 text-center">Загрузите файлы выполненного заказа:</h3>
                <file-manager entity="OrderFulfillment" id="{{ $order->fulfillment->id }}"></file-manager>
                <div class="flex justify-center py-3">
                    <request-action text="Вы уверены, что готовы завершить выполнение заказа?" route="/"><div class="btn btn-active">Отправить на проверку</div></request-action>
                </div>
            </div>
        </div>
        
        
        
    </div>
    
    


    
    
@endsection