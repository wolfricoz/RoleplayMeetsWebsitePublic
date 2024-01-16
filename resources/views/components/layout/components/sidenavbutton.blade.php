<a
    class="my-1 inline-flex border-gray-200 fill-stone-600 p-3 text-gray-700 transition-all ease-in-out hover:cursor-pointer hover:border-b hover:bg-gray-50 hover:fill-indigo-900 hover:text-black"
    href="{{ $attributes["href"] }}"
>
    <span class="items-center justify-center">
        {{ $icon }}
    </span>
    <span class="ml-2 font-bold" x-show="open">
        {{ $slot }}
    </span>
</a>
