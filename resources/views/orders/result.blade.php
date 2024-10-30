@extends('layouts.app')

@section('content')
    <div class="relative"> 
        <h1>Выполнение заказа № {{ $order->id }}</h1> 
        <div class="flex gap-3">
            <div class="basis-3/4">
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
            </div>
            <div class="basis-1/4 py-3 my-3 flex flex-col gap-3">
                @if($order->fulfillment->status === \App\Models\OrderFulfillment::STATUS_IN_PROGRESS)
                    <button class="btn btn-active">Отправить оплату</button>
                @endif
                <a href="{{ route('orders.publish', $order) }}" class="btn btn-secondary">Редактировать файлы</a>
                
                <a class="btn btn-secondary">Запросить отмену</a>
            </div> 
        </div>
        
        <div class="flex gap-3">
            
            <div class="basis-1/2 border p-2">
                <h3 class="font-bold my-3 text-center">Чат</h3>
                @include('blocks.chat')
            </div>
            <div class="basis-1/2 border p-2">
                <h3 class="font-bold my-3 text-center">Файлы исполнителя</h3>
                @if($order->fulfillment_status === \App\Models\OrderFulfillment::STATUS_CONFIRMATION || 
                $order->fulfillment_status === \App\Models\OrderFulfillment::STATUS_COMPLETED)
                    @foreach($order->fulfillment->files as $file)
                    <div class="py-2 px-4 relative rounded-sm bg-gray-100 flex gap-3 items-center mb-3">
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
                @else
                    <div class="my-3 text-center">Файлы будут доступны после того, как исполнитель пометит заказ выполненным</div>
                @endif
            </div>
        </div>
        
        
        
    </div>
    
    


    
    
@endsection