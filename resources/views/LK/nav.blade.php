<ul class="flex-column space-y space-y-4 text-sm font-medium text-gray-500 dark:text-gray-400 md:me-4 mb-4 md:mb-0">
    @if(Auth::user()->customer)
    <li>
        <a href="{{ route('orders.create') }}"  
         class="inline-flex text-lg rounded-lg items-center px-4 py-3 transition-all bg-gradient-to-r from-amber-600 to-orange-700  text-white hover:opacity-90 hover:shadow-sm font-bold w-full"
        aria-current="page">
            Новый заказ
        </a>
    </li>
    @endif
    <a href="{{ route('lk') }}" 
             @if(request()->route() and request()->route()->getName() === 'lk')
              class="inline-flex text-lg  items-center px-4 py-3 text-white bg-cyan-600 rounded-lg active w-full"
              @else
              class="inline-flex text-lg  items-center px-4 py-3 transition-all text-cyan-800 font-bold hover:text-cyan-600 bg-gray-50 rounded-lg hover:bg-gray-100 w-full"
              @endif
              aria-current="page">
                 Основная информация
             </a>
    @if(Auth::user()->executor and false)
    <li>
        <a href="{{ route('lk.responses') }}" 
        @if(request()->route() and request()->route()->getName() === 'lk.responses')
         class="inline-flex text-lg  items-center px-4 py-3 text-white bg-cyan-600 rounded-lg active w-full"
         @else
         class="inline-flex text-lg  items-center px-4 py-3 transition-all text-cyan-800 font-bold hover:text-cyan-600 bg-gray-50 rounded-lg hover:bg-gray-100 w-full"
         @endif
         aria-current="page">
            Отклики
        </a>
    </li>
         <li>
             <a href="{{ route('lk.tasks') }}" 
             @if(request()->route() and request()->route()->getName() === 'lk.tasks')
              class="inline-flex text-lg  items-center px-4 py-3 text-white bg-cyan-600 rounded-lg active w-full"
              @else
              class="inline-flex text-lg  items-center px-4 py-3 transition-all text-cyan-800 font-bold hover:text-cyan-600 bg-gray-50 rounded-lg hover:bg-gray-100 w-full"
              @endif
              aria-current="page">
                 Взятые заказы
             </a>
         </li>
    @endif
    @if(Auth::user()->customer) 
        <li>
            <a href="{{ route('lk.orders') }}"  
            @if(request()->route() and request()->route()->getName() === 'lk.orders')
              class="inline-flex text-lg  items-center px-4 py-3 text-white bg-cyan-600 rounded-lg active w-full"
              @else
              class="inline-flex text-lg  items-center px-4 py-3 transition-all text-cyan-800 font-bold hover:text-cyan-600 bg-gray-50 rounded-lg hover:bg-gray-100 w-full"
              @endif
            aria-current="page">
                Размещённые заказы
            </a>
        </li>
    @endif
    @if(Auth::user()->executor and false)
    <li>
        <a href="#" 
        @if(request()->route() and request()->route()->getName() === 'lk.executor')
              class="inline-flex text-lg  items-center px-4 py-3 text-white bg-cyan-600 rounded-lg active w-full"
              @else
              class="inline-flex text-lg  items-center px-4 py-3 transition-all text-cyan-800 font-bold hover:text-cyan-600 bg-gray-50 rounded-lg hover:bg-gray-100 w-full"
              @endif
        aria-current="page">
            Профиль исполнителя
        </a>
    </li>
    @endif
    @if(Auth::user()->customer)
    <li>
        <a href="{{ route('lk.customer') }}"
        @if(request()->route() and request()->route()->getName() === 'lk.customer')
              class="inline-flex text-lg  items-center px-4 py-3 text-white bg-cyan-600 rounded-lg active w-full"
              @else
              class="inline-flex text-lg  items-center px-4 py-3 transition-all text-cyan-800 font-bold hover:text-cyan-600 bg-gray-50 rounded-lg hover:bg-gray-100 w-full"
              @endif
        class="inline-flex items-center px-4 py-3 text-white bg-cyan-600 rounded-lg active w-full" aria-current="page">
            Профиль заказчика
        </a>
    </li>
    @endif
    <li>
        <a href="{{ route("lk.user") }}"
        @if(request()->route() and request()->route()->getName() === 'lk.user')
              class="inline-flex text-lg  items-center px-4 py-3 text-white bg-cyan-600 rounded-lg active w-full"
              @else
              class="inline-flex text-lg  items-center px-4 py-3 transition-all text-cyan-800 font-bold hover:text-cyan-600 bg-gray-50 rounded-lg hover:bg-gray-100 w-full"
              @endif
        class="inline-flex items-center px-4 py-3 text-white bg-cyan-600 rounded-lg active w-full" aria-current="page">
            Данные пользователя
        </a>
    </li>
    <li>
        <a href="{{ route('lk.purchases') }}"
        @if(request()->route() and request()->route()->getName() === 'lk.purchases')
            class="inline-flex text-lg  items-center px-4 py-3 text-white bg-cyan-600 rounded-lg active w-full"
        @else
            class="inline-flex text-lg  items-center px-4 py-3 transition-all text-cyan-800 font-bold hover:text-cyan-600 bg-gray-50 rounded-lg hover:bg-gray-100 w-full"
        @endif
            aria-current="page">Покупки</a>
    </li>
    <li>
        <a href="#"
        @if(request()->route() and request()->route()->getName() === 'lk.conversations')
            class="inline-flex text-lg  items-center justify-center px-4 py-3 text-white bg-cyan-600 rounded-lg active w-full"
        @else
            class="inline-flex text-lg  items-center px-4 py-3 transition-all text-cyan-800 font-bold hover:text-cyan-600 bg-gray-50 rounded-lg hover:bg-gray-100 w-full"
        @endif
            aria-current="page">Сообщения</a>
    </li>
</ul>

