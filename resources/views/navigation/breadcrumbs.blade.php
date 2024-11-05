<nav class="flex mb-4" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li class="inline-flex items-center">
            <a href="/" class="inline-flex items-center text-lg font-medium text-gray-700 hover:text-teal-600 transition-color">
                Главная</span>
            </a>
        </li>
        @if(isset($parent))
            <li>
                <div class="flex items-center">
                    <span>
                        <i class="fa-solid fa-arrow-right"></i> <a href="{{ $parent['url'] }}" class="ms-1 text-lg font-medium text-gray-700 hover:text-teal-600 transition-color md:ms-2">{{ $parent['title'] }}</a>
                    </span>
                </div>
            </li>
        @endif

        @isset($title)
            <li aria-current="page">
                <div class="flex items-center">
                    <span><i class="fa-solid fa-arrow-right"></i> <span class="ms-1 text-lg font-medium text-gray-500 md:ms-2">{{ $title }}</span></span>
                </div>
            </li>
        @endisset
        @if(isset($exception))
            <li aria-current="page">
                <div class="flex items-center">
                    <i class="fa-solid fa-chevron-right"></i>
                    <span class="ms-1 text-lg font-medium text-gray-500 md:ms-2">Ошибка {{ $exception->getStatusCode() }}</span>
                </div>
            </li>
        @endif
    </ol>
</nav>

