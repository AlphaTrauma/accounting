<div class="flex justify-between items-center border-b border-slate-200 py-3 px-2 border-l-4
        border-l-transparent bg-gradient-to-r to-slate-200 from-transparent mb-2 text-lg">
            <div class="space-x-2"> 
                <a class="link" href="{{ route('orders.show', $order) }}">{{ $order->title }} (файлов: {{ $order->files_count }})</a>
            </div> 
            <div class="flex gap-2">
                <modal-button classes="sm btn-sm bg-white" text="{{ $order->responses_count }} откликов" 
                    name="responses-list" :args="{'order_id' : {{ $order->id }} }"></modal-button>
                 
                <a href="{{ route('orders.publish', $order)}}" title="Файлы" class="btn btn-sm bg-white">
                    <i class="fa-regular fa-folder-open"></i>
                </a>
                
                <a href="{{ route('orders.edit', $order)}}" title="Редактировать" class="btn btn-sm bg-white">
                    <i class="fa fa-pen"></i>
                </a>
                <request-action text="Вы уверены, что хотите удалить заказ?" route="{{ route('orders.remove', $order) }}">
                    <div title="Удалить" class="btn btn-sm bg-white">
                        <i class="fa fa-trash"></i>
                    </div>
                </request-action>
                
            </div> 
        </div>