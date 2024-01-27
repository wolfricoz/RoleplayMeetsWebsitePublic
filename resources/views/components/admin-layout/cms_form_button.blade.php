<button
  class="{{ $attributes["class"] ?? "border-blue-700 hover:bg-blue-600 " }} col-span-1 w-32 rounded-full border transition-all hover:text-white px-2"
  name="{{ $attributes["name"] }}"
  value="{{ $attributes["value"] }}"
  @isset($attributes["formaction"])
      formaction="{{ $attributes["formaction"] }}"
  @endisset()
  onclick="{{ $attributes["onclick"] }}"
>
  {{ $slot }}
</button>
