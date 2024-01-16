@if ($permission)
    <a href="{{ $attributes["href"] }}">
        <div
            class="flex w-full justify-between p-4 text-sm font-semibold hover:border-r hover:border-indigo-800 hover:bg-gray-100 hover:text-indigo-900"
        >
            <span>
                {{ $slot }}
            </span>
            @isset($display)
                <span
                    class="h-5 w-10 overflow-hidden rounded-full bg-indigo-800 text-center text-white"
                >
                    {{ $display }}
                </span>
            @endisset
        </div>
    </a>
@endif()
