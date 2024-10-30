<div class="float-end bg-gray-100 rounded-lg max-w-sm w-full py-3 px-5">
    <div class="flex gap-2 justify-between my-3">
        <h2 class="font-bold">Заказчик</h2>
        <p class="underline text-xl">{{ $user->name }}</p>
    </div>
    
    
    <p class="my-3">Всего заказов: {{ $user->orders_count }}</p>
    <div class="my-3" title="Рейтинг заказчика">
        <x-rating rating="7"></x-rating>
    </div>
</div>