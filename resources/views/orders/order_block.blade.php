<a href="{{ route('orders.show', $order) }}" class="block w-full max-w-[33%] p-6 bg-gray-200  rounded-lg shadow hover:bg-gray-300">
                <small class="float-end">от {{ $order->user->name }}</small>
                <h5 class="mb-2 text-2xl font-bold  text-gray-900 dark:text-white">{{ $order->title }}</h5>
                <p class="font-normal text-gray-700">{{ $order->description }}</p>
                <hr class="my-5">
                <div class="flex justify-between items-center">
                    <div>
                        <b>Вложений:</b> {{ $order->files_count }}
                    </div>
                    <div>
                        <span class=" text-teal-600 font-bold"><span class="text-2xl">{{ number_format($order->sum, 0, '', ' ') }}</span> ₽</span>
                    </div>
                </div>
            </a>