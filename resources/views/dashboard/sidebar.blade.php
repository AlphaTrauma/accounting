<aside class="w-64 bg-white shadow-lg">
    <ul class="mt-4">
        <li><a href="{{ route('users') }}" class="py-2 px-4 text-gray-700 hover:bg-teal-200 flex gap-4 items-center">
            <i class="fa fa-user"></i>
            <span class="font-bold">Пользователи</span>
        </a>
    </li>
        <li><a href="{{ route('slider') }}" class="py-2 px-4 text-gray-700 hover:bg-teal-200 flex gap-4 items-center">
            <i class="fa-solid fa-panorama"></i>
            <span class="font-bold">Слайдер</span>
        </a>
    </li>
        <li><a href="{{ route('menu') }}" class="py-2 px-4 text-gray-700 hover:bg-teal-200 flex gap-4 items-center">
                <i class="fa-solid fa-bars"></i>
                <span class="font-bold">Навигация</span>
            </a>
        </li>
        <li><a href="{{ route('affiliate') }}" class="py-2 px-4 text-gray-700 hover:bg-teal-200 flex gap-4 items-center">
            <i class="fa-solid fa-handshake-simple"></i>
            <span class="font-bold">Партнёрские категории</span>
        </a>
    </li>
        <li><a href="{{ route('categories') }}" class="py-2 px-4 text-gray-700 hover:bg-teal-200 flex gap-4 items-center">
            <i class="fa-solid fa-pen-to-square"></i>
            <span class="font-bold">Категории</span>
        </a>
    </li>
        <li><a href="{{ route('article.list') }}" class="py-2 px-4 text-gray-700 hover:bg-teal-200 flex gap-4 items-center">
                <i class="fa-solid fa-pen-to-square"></i>
                <span class="font-bold">Статьи</span>
            </a>
        </li>
        <li><a href="{{ route('page.list') }}" class="py-2 px-4 text-gray-700 hover:bg-teal-200 flex gap-4 items-center">
            <i class="fa-solid fa-pen-to-square"></i>
            <span class="font-bold">Страницы</span>
        </a>
    </li>
    <li><a href="{{ route('guides.list') }}" class="py-2 px-4 text-gray-700 hover:bg-teal-200 flex gap-4 items-center">
        <i class="fa-solid fa-file"></i>
        <span class="font-bold">Гайды</span>
    </a>
</li>
        <li>
            <a href="#" class=" py-2 px-4 text-gray-700 hover:bg-teal-200 flex gap-4 items-center">
                <i class="fa-solid fa-comment-slash"></i>
               <span class="font-bold">Модерация</span>
            </a>
        </li>
        <li><a href="#" class="py-2 px-4 text-gray-700 hover:bg-teal-200 flex gap-4 items-center">
                <i class="fa-solid fa-gear"></i>
                <span class="font-bold">Настройки</span>
            </a>
        </li>
        <li>
            <a href="{{ route('log-viewer::logs.index') }}" class="py-2 px-4 text-gray-700 hover:bg-teal-200 flex gap-4 items-center">
                <i class="fa-solid fa-screwdriver-wrench"></i>
               <span class="font-bold">Технический лог</span>
            </a>
        </li>
    </ul>
</aside>
