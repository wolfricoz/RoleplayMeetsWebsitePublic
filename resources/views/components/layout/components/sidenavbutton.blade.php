<a class="inline-flex my-1 p-3 text-gray-700 hover:bg-gray-50 hover:cursor-pointer  hover:text-black hover:border-b border-gray-200 transition-all ease-in-out">
    <span class="items-center justify-center">
        {{ $icon }}
    </span>
    <span class="ml-2 font-bold " x-show="open">
        {{ $slot }}
    </span>
</a>
