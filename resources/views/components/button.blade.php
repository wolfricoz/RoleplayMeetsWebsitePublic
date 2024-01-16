<a
    class="m-2.5 mx-0.5 cursor-pointer whitespace-nowrap rounded border border-gray-500 bg-transparent px-2 py-1 text-sm font-semibold text-gray-700 hover:border-transparent hover:bg-indigo-900 hover:text-white"
    @isset($layout)
        x-on:click="layout = '{{ $layout }}'"
        x-bind:class="{ 'bg-indigo-200': layout === '{{ $layout }}' }"
    @endisset
    @isset($attributes["href"])
        href="{{ $attributes["href"] }}"
    @endisset
>
    {{ $slot }}
</a>
