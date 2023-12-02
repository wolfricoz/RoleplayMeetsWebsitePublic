{{--Alright, we will be making a nav bar here, one on top and one on the side.--}}

<div class="flex-wrap h-full w-full" >
    <nav class="flex flex-row basis-full w-full border-b border-stone-200 bg-gray-100 h-12" x-on:mouseleave="dropdown = false">

        <div class="inline-flex w-full h-full ">
            <a href="{{ route('home') }}"
               class="w-32 lg:w-44 h-full text-center text-gray-700 hover:cursor-pointer  hover:text-indigo-900 transition-all ease-in-out">
                <h1 class="pt-2.5 lg:pt-0 lg:text-lg  font-bold">Roleplay Meets</h1>
                <h6 class="text-sm hidden lg:block">Where roleplayers meet.</h6>
            </a>

            <a class="hover:cursor-pointer ">
                <x-layout.SVG.sidebar-icon/>
            </a>

            <div class="w-36 lg:w-fit">
                <form>
                    <input type="text" placeholder="Search"
                           class="border border-stone-200 rounded-md p-1 mt-2 w-16 lg:w-32"
                           name="search" id="search">
                    <button type="submit" class="w-16 text-sm bg-transparent  text-gray-700 font-semibold hover:text-white py-1 px-2 border border-gray-500
                    hover:border-transparent hover:bg-indigo-900 rounded">Search
                    </button>
                </form>
            </div>

        </div>
        <div
            class="inline-flex w-fit lg:min-w-[208px] max-w-xl h-full text-center text-gray-700 hover:bg-gray-50 hover:cursor-pointer  hover:text-black content-right"
            x-on:click="dropdown = !dropdown"
        >
            @auth()

                <span
                    class="hidden lg:block ml-auto py-3.5 px-0.5 overflow-hidden {{ strlen(auth()->user()->global_name) > 15 ? "text-xs pt-4" : "py-3.5"}} ">{{ auth()->user()->global_name }}</span>

                <img class=" h-8 w-8 mt-2 mx-2 rounded-full object-cover border border-gray-200"
                     src="{{ Auth::user()->getAvatar(['extension' => 'webp', 'size' => 32]) }}"
                     alt="{{ Auth::user()->getTagAttribute() }}"/>
            @else
                <a href="{{ route('login') }}" class="py-3 px-0.5">
                    <x-layout.SVG.login-icon/>
                </a>
            @endauth

        </div>
        <div x-show="dropdown" class="" x-cloak>
            <div class="flex flex-col absolute right-0 top-12 w-52 border-stone-200 bg-gray-100">
                <a href=""
                   class="w-full h-full p-2 text-center text-gray-700 hover:bg-gray-50 hover:cursor-pointer  hover:text-black hover:border-b hover:border-indigo-900 content-right ">
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit">logout</button>
                    </form>
                </a>
            </div>


        </div>

    </nav>
    <div class="flex h-full max-h-[95vh] w-full">
        <aside class="flex flex-col h-full border border-stone-200 bg-gray-100 "
               :class="{'w-fit': !open, 'w-48': open}" x-cloak>
            <x-layout.components.sidenavbutton>
                <x-slot name="icon">
                    <x-layout.SVG.home-icon/>
                </x-slot>
                Home
            </x-layout.components.sidenavbutton>
            <x-layout.components.sidenavbutton>
                <x-slot name="icon">
                    <x-layout.SVG.rules-icon/>
                </x-slot>
                rules
            </x-layout.components.sidenavbutton>
            <x-layout.components.sidenavbutton>
                <x-slot name="icon">
                    <x-layout.SVG.groups-icon/>
                </x-slot>
                Groups
            </x-layout.components.sidenavbutton>
        </aside>
        <div class="w-full  h-full max-w-full overflow-y-scroll">
            {{ $slot }}


        </div>
    </div>

</div>
