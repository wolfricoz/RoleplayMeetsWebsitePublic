<div class="w-full my-2">
    <div class="inline-flex">
        <p class="w-36 font-bold">{{ $slot }}</p>
        @isset($toggle)
            <label class="inline-flex items-center rounded-md cursor-pointer dark:text-gray-800">
                <input name="show_{{ $attributes['name'] }}" type="checkbox" class="hidden peer" {{ $toggle ? 'checked' : '' }}>
                <span class="px-4  rounded-l-md bg-green-500 peer-checked:bg-gray-500">Hidden</span>
                <span class="px-4 rounded-r-md bg-gray-500 peer-checked:bg-blue-400">Public</span>
            </label>
        @else

        @endisset()

    </div>

    <label>


        <input type="{{ $attributes['type'] ?? 'text' }}"
               name="{{ $attributes['name'] }}"
               value="{{ $attributes['value'] }}"
               class="block mt-1 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"
        />

    </label>
</div>
