<div id="mobile-menu" class="fixed z-50 h-full w-full transition-all duration-300 left-0 md:hidden -translate-x-full " >
    <div class="flex h-full">
        <div class="min-w-[300px] shadow-lg bg-white">
            <div class="mx-auto p-2 text-lg">
                <a href="#" class="flex items-center space-x-3 text-teal-800 py-3 px-5">
                    <i class="fa-solid fa-share-nodes"></i>
                    <span class="self-center text-2xl font-semibold whitespace-nowrap">СчётКоннект</span>
                </a> 
            </div>
            <nav class="p-4 text-2xl">
                <ul>
                    <li class="mb-2">
                        <a href="/dashboard" class="py-3 block">Админка</a>
                    </li>
                    <li class="mb-2">
                        @if(request()->route() and request()->route()->getName() === 'home')
                            <div class="relative font-semibold"><div class="block py-3  text-teal-800">Главная</div></div>
                        @else
                            <a href="/" class="block py-3 text-gray-900 font-semibold">Главная</a>
                        @endif 
                    
                    @foreach($navItems[""] ?? [] as $navItem)
                        @if($navItems->has($navItem->id))
                            @foreach($navItems[$navItem->id] as $navChild)
                                @if($navChild->is_mobile)
                                <li>
                                    @if(request() && '/'.request()->path() === $navChild->url)
                                        <div class="block px-4 py-2 text-teal-800 whitespace-nowrap">
                                            {{ $navChild->title }}
                                        </div>
                                    @else
                                        <a href="{{ $navChild->url }}" class="block mb-2 py-3 w-full whitespace-nowrap">
                                            {{ $navChild->title }}
                                        </a>
                                    @endif
                                </li>
                                @endif
                            @endforeach
                        @else
                            @if($navItem->is_mobile)
                            <li>
                                @if('/'.request()->path() === $navItem->url)
                                    <div class="block mb-2 py-3 text-teal-600" aria-current="page">{{ $navItem->title }}</div>
                                @else
                                    <a href="{{ $navItem->url }}" class="block mb-2 py-3" >{{ $navItem->title }}</a>
                                @endif
                            </li> 
                            @endif
                        @endif
                    @endforeach 
                </ul>
            </nav>
        </div>
        <div class="bg-gradient-to-b from-black to-[#0000003f] h-full w-full"  id="burger-close">
            <button data-collapse-toggle="navbar-dropdown" type="button" class="inline-flex items-center p-5 text-white
            justify-center rounded-lg md:hidden  focus:outline-none  " aria-controls="navbar-dropdown"
                    aria-expanded="false">
                <span class="sr-only">Открыть главное меню</span>
                <i class="fa-solid fa-xmark"></i>
                
            </button>
        </div>
        
    </div>
</div>