<affiliates></affiliates>


<div class="w-full  bg-gradient-to-br from-gray-400 to-gray-100 pt-10">
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
                <div class="flex gap-3 py-5">
                    @for($i = 0; $i < 3; $i++)
                        <div class="block basis-1/3 p-4 bg-gray-200  rounded-lg shadow hover:bg-gray-300">
                            <h5 class="mb-2 text-2xl font-bold  text-gray-900 dark:text-white">Исполнитель
                                #{{ $i + 1 }}</h5>
                            <p class="font-normal text-gray-700">Характеристика</p>
                            <hr class="my-5">
                            <div class="flex justify-between items-center">

                                <div>
                                    <span class=" text-teal-600 font-bold"><span class="text-2xl">От
                                            {{ number_format(($i + 1) * 1000, 0, '', ' ') }}</span>
                                        ₽</span>
                                </div>
                            </div>
                        </div>
                    @endfor

                </div>

                <div class="py-5 flex justify-end mb-4">
                    <a href="#" class="btn btn-primary">Больше исполнителей</a>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full bg-white py-10">
        <div class="max-w-screen-xl mx-auto">
            <p>Текстовое описание сайта</p>
        </div>
    </div>


        <div class="w-full bg-gradient-to-r from-teal-600 to-cyan-700 ">
            
            <div class="bg-no-repeat bg-cover bg-right md:bg-[url('http://accounting.test/images/graph1.png')]  py-10">
                <div class="max-w-screen-xl mx-auto">
                    <h2 class="text-3xl text-white font-semibold my-3">
                        Как начать работу с сайтом
                    </h2>
                    <div class="py-3 flex gap-3">
                        <div
                            class="flex items-center justify-around text-center py-3 px-7 basis-1/4 h-40 bg-white rounded-md relative shadow-lg">
                            <p>Регистрируетесь в качестве исполнителя или заказчика</p>
                        </div>
                        <div
                            class="flex items-center justify-around text-center py-3 px-7 basis-1/4 h-40 bg-white rounded-md relative shadow-lg">
                            <p>Размещаете заказ</p>
                            <div class="absolute left-[-35px] top-[35%] text-cyan-600 drop-shadow-md text-6xl">
                                <i class="fa-solid fa-right-long"></i>
                            </div>
                        </div>
                        <div
                            class="flex items-center justify-around text-center py-3 px-7 basis-1/4 h-40 bg-white rounded-md relative shadow-lg">
                            <p>Выбираете исполнителя среди откликнувшихся</p>
                            <div class="absolute left-[-35px] top-[35%] text-cyan-600 drop-shadow-md text-6xl">
                                <i class="fa-solid fa-right-long"></i>
                            </div>
                        </div>
                        <div
                            class="flex items-center justify-around text-center py-3 px-7 basis-1/4 h-40 bg-white rounded-md relative shadow-lg">
                            <p>Получаете результат</p>
                            <div class="absolute left-[-35px] top-[35%] text-cyan-600 drop-shadow-md text-6xl">
                                <i class="fa-solid fa-right-long"></i>
                            </div>
                        </div>
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
    </div>
