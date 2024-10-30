<div class="text-gray-600 text-center text-sm">Соблюдайте правила сайта при общении в чате. Обмен контактами запрещён.</div>

<div class="max-h-[800px] overflow-y-auto">
    <div class="flex justify-start my-3">
        <div class="flex flex-col w-full max-w-[400px] leading-1.5 p-4 ml-4 mr-4 bg-gray-200 shadow rounded-xl rounded-tl-none">
            <div class="flex items-center space-x-2 ">
               <span class="text-sm font-semibold text-gray-900">{{ $order->executor->name }} {{ $order->executor->last_name }}</span>
               <span class="text-sm font-normal text-gray-500">11:46</span>
            </div>
            <p class="text-sm font-normal py-2.5 text-gray-900">Насколько жёсткий дедлайн? Можно в рамках двух дней просрочить?</p>
         </div>
    </div>

    <div class="flex justify-end my-3">
     <div class="flex flex-col w-full max-w-[400px] leading-1.5 p-4 ml-4 mr-4 bg-white shadow rounded rounded-xl border rounded-tr-none">
        <div class="flex items-center space-x-2 ">
           <span class="text-sm font-semibold text-gray-900">{{ $order->customer->user->name }}</span>
           <span class="text-sm font-normal text-gray-500">12:10</span>
        </div>
        <p class="text-sm font-normal py-2.5 text-gray-900">Да, если точно уверены, что справитесь. 
            Но лучше предупредите чуть заранее, если задержитесь, или покажите промежуточный результат!</p> 
     </div> 
    </div>

    <div class="flex justify-start my-3">
        <div class="flex flex-col w-full max-w-[400px] leading-1.5 p-4 ml-4 mr-4 bg-gray-200 shadow rounded-xl rounded-tl-none">
            <div class="flex items-center space-x-2 ">
               <span class="text-sm font-semibold text-gray-900">{{ $order->executor->name }} {{ $order->executor->last_name }}</span>
               <span class="text-sm font-normal text-gray-500">13:03</span>
            </div>
            <p class="text-sm font-normal py-2.5 text-gray-900">Хорошо, спасибо</p>
         </div>
    </div>
 </div>
 <div class="p-3 flex gap-1">
    <div style="min-height: 100px;" class="border p-3 w-full rounded active:border-teal-600 active:ring-teal-600 focus:border-teal-600 focus:ring-teal-600" contenteditable >

    </div>
    <button class="btn btn-active">
        <i class="fa-solid fa-paper-plane"></i>
    </button>
 </div>
 
 