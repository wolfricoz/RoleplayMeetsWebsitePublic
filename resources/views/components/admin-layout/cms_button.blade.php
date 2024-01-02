@if($permission)
    <a href="{{ $attributes['href'] }}">
        <div class="flex justify-between  p-4 w-full text-sm font-semibold
                hover:bg-gray-100 hover:border-indigo-800 hover:text-indigo-900 hover:border-r
                ">
            <span>
                {{ $slot }}
            </span>
            @isset($display)
            <span class="bg-indigo-800 rounded-full h-5 w-10 text-center overflow-hidden text-white">
                {{ $display }}
            </span>
            @endisset
        </div>
    </a>
@endif()
