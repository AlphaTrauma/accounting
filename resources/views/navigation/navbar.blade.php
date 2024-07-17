<nav  id="navbar" class="bg-transparent fixed top-0 left-0 w-full max-w-[100vw] py-2 transition-all">
    <div class=" max-w-full md:max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-2 text-lg bg-transparent">
        @if(request()->route() and request()->route()->getName() === 'home')
        <div  class="flex items-center space-x-3 text-teal-800 py-3 px-5">
            <i class="fa-solid fa-share-nodes"></i>
            <span class="self-center text-2xl font-semibold whitespace-nowrap">СчётКоннект</span>
        </div> 
        @else
        <a href="/" class="flex items-center space-x-3 text-teal-800 py-3 px-5">
            <i class="fa-solid fa-share-nodes"></i>
            <span class="self-center text-2xl font-semibold whitespace-nowrap">СчётКоннект</span>
        </a> 
        @endif
        
        <button data-collapse-toggle="navbar-dropdown" id="burger" type="button" class="inline-flex items-center p-2 w-10 h-10 text-teal-800
        justify-center rounded-lg md:hidden hover:bg-gray-100 focus:outline-none " aria-controls="navbar-dropdown"
                aria-expanded="false">
            <span class="sr-only">Открыть главное меню</span>
            <svg class="w-full h-full" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
        <div class="w-full hidden md:block md:w-auto">
            <div class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent">
                @if(request()->route() and request()->route()->getName() === 'home')
                    <div class="relative font-semibold"><div class="block py-2 px-3 text-teal-600" aria-current="page">Главная</div></div>
                @else
                    <a href="/" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent font-semibold" aria-current="page">Главная</a>
                @endif
                @foreach($navItems[""] ?? [] as $navItem)
                    <div class="relative font-semibold">
                        @if($navItems->has($navItem->id))
                            <div class=" py-2 px-3 cursor-pointer dropdown-parent flex items-center
                                 @if('/'.request()->path() === $navItem->url) text-teal-600 @else text-gray-800 @endif"
                                 aria-current="page">{{ $navItem->title }} <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="ml-2 w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>

                            </div>
                            <div class="dropdown absolute top-[100%] right-0 transition-all bg-[#ffffff79] font-medium shadow-sm min-w-full text-center">
                                <ul>
                                    @foreach($navItems[$navItem->id] as $navChild)
                                    <li>
                                        @if('/'.request()->path() === $navChild->url)
                                            <div class="block px-4 py-2 text-teal-600 whitespace-nowrap">
                                                {{ $navChild->title }}
                                            </div>
                                        @else
                                            <a href="{{ $navChild->url }}" class="block px-4 py-2 border-l-4 border-transparent hover:border-l-cyan-600 
                                                transition-all whitespace-nowrap">
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
    <div class="absolute right-0 top-0 h-[100%] hidden md:flex items-center justify-center px-6">
        @auth
            <a href="/dashboard" class="p-4 bg-white shadow-sm rounded-md text-gray-700"><i class="fa-solid fa-circle-user"></i> {{ Auth::user()->name }}</a>
        @endauth
        @guest
            <a href="/register" class="btn btn-active">Зарегистрироваться</a>
        @endguest
    </div>
</nav>


