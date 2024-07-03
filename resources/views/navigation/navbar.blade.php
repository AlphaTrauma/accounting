
<nav class="bg-transparent shadow-md relative">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-3 text-lg">


        <a href="#" class="flex items-center space-x-3 bg-gradient-to-r from-indigo-600 to-teal-600 py-3 px-5">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">БухКоннект</span>
        </a>
        <button data-collapse-toggle="navbar-dropdown" type="button" class="inline-flex items-center p-2 w-10 h-10
        justify-center text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2
        focus:ring-gray-200" aria-controls="navbar-dropdown"
                aria-expanded="false">
            <span class="sr-only">Открыть главное меню</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
        <div class="w-full md:block md:w-auto">
            <div class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent">
                @if(request()->route() and request()->route()->getName() === 'home')
                    <div class="relative font-semibold"><div class="block py-2 px-3 text-teal-600" aria-current="page">Главная</div></div>
                @else
                    <a href="/" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent font-semibold" aria-current="page">Главная</a>
                @endif
                @foreach($navItems[""] as $navItem)
                    <div class="relative font-semibold">
                        @if($navItems->has($navItem->id))
                            <div class="block py-2 px-3 cursor-pointer dropdown-parent flex items-center
                                 @if('/'.request()->path() === $navItem->url) text-teal-600 @else text-gray-800 @endif"
                                 aria-current="page">{{ $navItem->title }} <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="ml-2 w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>

                            </div>
                            <div class="dropdown absolute top-[100%] right-0 transition-all bg-white font-medium shadow-sm">
                                <ul>
                                    @foreach($navItems[$navItem->id] as $navChild)
                                    <li>
                                        @if('/'.request()->path() === $navChild->url)
                                            <div class="block px-4 py-2 text-teal-600 whitespace-nowrap">
                                                {{ $navChild->title }}
                                            </div>
                                        @else
                                            <a href="{{ $navChild->url }}" class="block px-4 py-2 hover:bg-teal-50 whitespace-nowrap">
                                                {{ $navChild->title }}
                                            </a>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            @if('/'.request()->path() === $navItem->url)
                                <div class="block py-2 px-3 text-teal-600" aria-current="page">{{ $navItem->title }}</div>
                            @else
                                <a href="{{ $navItem->url }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent" aria-current="page">{{ $navItem->title }}</a>
                            @endif
                        @endif

                    </div>
                @endforeach
            </div>

        </div>

    </div>
    <div class="absolute right-0 top-0 h-[100%] flex items-center justify-center px-6">
        @auth
            <a href="/dashboard" class="link">{{ Auth::user()->name }}</a>
        @endauth
        @guest
            <a href="/register" class="btn btn-active">Зарегистрироваться</a>
        @endguest
    </div>
</nav>

