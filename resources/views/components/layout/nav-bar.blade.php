{{--Alright, we will be making a nav bar here, one on top and one on the side.--}}

<div class="flex h-full  w-full">


    <aside class="flex flex-col h-screen w-48 border border-stone-200 bg-gray-100 rounded">
        <div class="mt-4 w-full text-center border-b text-black dark:text-white">
            <h1 class="text-xl font-bold">Roleplay Meets</h1>
            <h6 class="text-sm">Where roleplayers meet.</h6>
        </div>
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

    <div class="w-full max-h-screen min-h-screen h-full max-w-full overflow-y-scroll">

            <nav class="flex flex-row basis-full w-full border-b border-stone-200 bg-gray-100 h-12">
                <div class="inline-flex w-full h-full">
                    test
                </div>
                <div class="inline-flex w-fit min-w-[200px] max-w-xl h-full text-center text-gray-700 hover:bg-gray-50 hover:cursor-pointer  hover:text-black content-right">
                    @auth()

                            <span class="ml-auto py-3.5 px-0.5 overflow-hidden {{ strlen(auth()->user()->global_name) > 15 ? "text-xs pt-4" : "py-3.5"}} text-sm ">{{ auth()->user()->global_name }}</span>

                            <img class=" h-8 w-8 mt-2 mx-2 rounded-full object-cover border border-gray-200" src="{{ Auth::user()->getAvatar(['extension' => 'webp', 'size' => 32]) }}" alt="{{ Auth::user()->getTagAttribute() }}" />
                    @else
                        <a href="{{ route('login') }}">
                            Login
                        </a>


                    @endauth

                </div>

            </nav>
            <div class="h-full max-h-full w-full">
                {{ $slot }}
            </div>


    </div>
</div>
