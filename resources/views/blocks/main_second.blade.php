<affiliates></affiliates>
 

<div class="w-full  bg-gradient-to-br from-gray-400 to-gray-100 py-10">
    <div class="max-w-screen-xl mx-auto px-5">
        <div class="max-w-screen-xl mx-auto min-h-[200px] ">
            <h2 class="text-4xl text-gray-700 font-semibold text-center mb-5">
                Задачи для бухгалтеров
            </h2>
            <div class="flex gap-3 py-5">
                @foreach($orders as $order)
                    @include('orders.order_block')
                @endforeach
            </div>
            <div class="py-5 flex justify-end">
                <a href="/orders/all" class="btn btn-primary">Больше задач</a>
            </div>
            <div class="max-w-screen-xl mx-auto px-5">
                <h2 class="text-4xl text-gray-700 font-semibold text-center my-5">
                    Биржа бухгалтеров
                </h2>
                <div class="py-3 flex gap-4">
                    <div class="basis-1/4 p-4 bg-white rounded-md relative pb-[80px]">
                        <h3 class="card-title">Ищу удалённую вакансию бухгалтера до 2ч в день</h3>
                        <p class="text-xl my-3">Татьяна В.</p>
                        <p class="text-xl my-3">28 лет, профильное образование</p> 
                        <div class="flex justify-end absolute bottom-0 left-0 w-full p-3 border-t"> 
                            <div class="py-2 text-orange-700 font-bold">от 25000 ₽/мес</div>
                        </div>
                   </div>
                   <div class="basis-1/4 p-4 bg-white rounded-md relative pb-[80px]">
                    <h3 class="card-title">Заголовок</h3>
                    <p class="text-xl my-3">Имя</p>
                    <p class="text-xl my-3">Описание</p> 
                    <div class="flex justify-end absolute bottom-0 left-0 w-full p-3 border-t"> 
                        <div class="py-2 text-orange-700 font-bold">Договорная</div>
                    </div>
               </div>
               <div class="basis-1/4 p-4 bg-white rounded-md relative pb-[80px]">
                <h3 class="card-title">Заголовок</h3>
                <p class="text-xl my-3">Имя</p>
                <p class="text-xl my-3">Описание</p> 
                <div class="flex justify-end absolute bottom-0 left-0 w-full p-3 border-t"> 
                    <div class="py-2 text-orange-700 font-bold">Договорная</div>
                </div>
           </div>
           <div class="basis-1/4 p-4 bg-white rounded-md relative pb-[80px]">
            <h3 class="card-title">Заголовок</h3>
            <p class="text-xl my-3">Имя</p>
            <p class="text-xl my-3">Описание</p> 
            <div class="flex justify-end absolute bottom-0 left-0 w-full p-3 border-t"> 
                <div class="py-2 text-orange-700 font-bold">Договорная</div>
            </div>
       </div>
                </div>
            </div>

            <div class="py-5 flex justify-end mb-4">
                <a href="#" class="btn btn-primary">В банк резюме</a>
            </div>
    </div>
</div>


<div class="w-full bg-gradient-to-r from-teal-600 to-cyan-700 ">
    <div class="bg-no-repeat bg-cover bg-right md:bg-[url('http://accounting.test/images/graph1.png')]  py-10">
        <div class="max-w-screen-lg mx-auto">
            <h2 class="text-3xl text-white font-semibold my-3">
            Как начать работу с сайтом
            </h2>
            <div class="py-3 flex gap-4">
                <div class="basis-1/4 h-40 bg-white rounded-md"></div>
                <div class="basis-1/4 h-40 bg-white rounded-md"></div>
                <div class="basis-1/4 h-40 bg-white rounded-md"></div>
                <div class="basis-1/4 h-40 bg-white rounded-md"></div>
            </div>
        </div>
    </div>
</div> 
<div class="w-full bg-white py-10">
    <div class="max-w-screen-xl mx-auto px-5">
         
        <div class="py-3 flex justify-center gap-4">
             <a href="#" class="btn btn-primary">
                <i class="fa-solid fa-calculator"></i> Калькулятор бухгалтерских услуг
             </a>
        </div>
    </div>
</div>
<hr>