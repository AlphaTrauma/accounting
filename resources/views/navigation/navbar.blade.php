<nav  id="navbar" class="bg-transparent fixed top-0 left-0 w-full max-w-[100vw] py-2 transition-all z-10">
        @if(Auth::user() and Auth::user()->admin)
            <a href="/dashboard" class="link absolute right-10 top-5">Управление</a>
        @endif
    <div class="my-2 max-w-full md:max-w-screen-xl flex flex-wrap items-center justify-between mx-auto text-lg bg-transparent">
        <div class="relative">
            <div class="absolute bottom-[50%] translate-y-[80%]">
                @if(request()->route() and request()->route()->getName() === 'home')
        <div  class="flex items-center space-x-3 text-teal-800 py-1 px-5">
            <i class="fa-solid fa-share-nodes"></i>
            <span class="self-center text-2xl font-semibold whitespace-nowrap">[Название сайта]</span>
        </div> 
        @else
        <a href="/" class="flex items-center space-x-3 text-teal-800 py-1 px-5">
            <i class="fa-solid fa-share-nodes"></i>
            <span class="self-center text-2xl font-semibold whitespace-nowrap">[Название сайта]</span>
        </a> 
        
        @endif
        <p class="text-center">Фриланс профессионалов</p>
            </div>
        </div>

       @auth
            <a href="{{ route('lk') }}" class="btn btn-sm btn-active "><i class="fa-solid fa-circle-user"></i> Мой кабинет</a>
        @endauth
        @guest
            <div class="flex gap-2">
                <a href="/register" class="btn btn-sm btn-active"><i class="fa-solid fa-right-to-bracket"></i> Я заказчик</a>
                <a href="/register" class="btn btn-sm btn-primary"><i class="fa-solid fa-right-to-bracket"></i> Я исполнитель</a>
            </div>
        @endguest
            
        

    </div>

    <div class="mb-2 max-w-full md:max-w-screen-xl flex flex-wrap items-center justify-end mx-auto text-2xl bg-transparent">
        
        
        <button data-collapse-toggle="navbar-dropdown" id="burger" type="button" class="inline-flex items-center p-2 w-10 h-10 text-teal-800
        justify-center rounded-lg md:hidden hover:bg-gray-100 focus:outline-none " aria-controls="navbar-dropdown"
                aria-expanded="false">
            <span class="sr-only">Открыть главное меню</span>
            <svg class="w-full h-full" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
        <div class="w-full hidden md:block md:w-auto">
            <div class="flex font-medium p-1 md:space-x-8 justify-end flex-row md:mt-0 bg-transparent">
                 
                @foreach($navItems[""] ?? [] as $navItem)
                    <div class="relative font-semibold">
                        @if($navItems->has($navItem->id))
                            <div class=" py-1 px-3 cursor-pointer dropdown-parent flex items-center
                                 @if('/'.request()->path() === $navItem->url)  text-gray-800   @else  text-cyan-800  hover:text-cyan-600 @endif"
                                 aria-current="page">{{ $navItem->title }} <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="ml-2 w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>

                            </div>
                            <div class="dropdown absolute top-[100%] right-0 transition-all bg-[#ffffff79] bg-white font-medium shadow-sm min-w-full text-center">
                                <ul>
                                    @foreach($navItems[$navItem->id] as $navChild)
                                    <li>
                                        @if('/'.request()->path() === $navChild->url)
                                            <div class="block px-4 py-1 text-gray-600 whitespace-nowrap">
                                                {{ $navChild->title }}
                                            </div>
                                        @else
                                            <a href="{{ $navChild->url }}" class="block px-4 py-1 border-l-[10px] border-l-cyan-600 hover:bg-cyan-600 hover:text-white
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
                                <div class="block py-1 px-3 text-gray-600" aria-current="page">{{ $navItem->title }}</div>
                            @else
                                <a href="{{ $navItem->url }}" class="block py-1 px-3 transition-all text-cyan-800  hover:text-cyan-600 md:hover:bg-transparent" aria-current="page">{{ $navItem->title }}</a>
                            @endif
                        @endif

                    </div>
                @endforeach
            </div>

        </div>

    </div>
</nav>


