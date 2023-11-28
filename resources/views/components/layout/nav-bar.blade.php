{{--Alright, we will be making a nav bar here, one on top and one on the side.--}}

<div class="flex h-full  w-full">


    <aside class="h-screen w-48 border border-black">
        <div class="my-4 w-full text-center border-b text-black dark:text-white">
            <h1 class="text-xl font-bold">Roleplay Meets</h1>
            <h6 class="text-sm">Where roleplayers meet.</h6>
        </div>
    </aside>

    <div class="w-full max-h-screen min-h-screen h-full max-w-full bg-red-500 overflow-y-scroll">
        <div class="flex flex-col"></div>
            <nav class="block basis-full w-full border border-black h-12">

            </nav>
            <div class="h-full max-h-full w-full">
                {{ $slot }}
            </div>

    </div>
</div>
