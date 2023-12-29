@if($permission)
    <a href="{{ $attributes['href'] }}">
        <div class="p-4 w-full text-sm font-semibold
                hover:bg-gray-100 hover:border-indigo-800 hover:text-indigo-900 hover:border-r
                ">
            {{ $slot }}
        </div>
    </a>
@endif()
