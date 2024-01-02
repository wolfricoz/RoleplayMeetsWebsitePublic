<button class="w-32 col-span-1 rounded-full border hover:text-white transition-all {{ $attributes['class'] ?? 'border-blue-700 hover:bg-blue-600 ' }}" name="{{ $attributes['name'] }}" value="{{ $attributes['value'] }}">
    {{ $slot }}
</button>
