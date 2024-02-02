<button
  class="{{ $attributes["class"] ?? "border-gray-500 hover:bg-indigo-900" }} col-span-1 cursor-pointer whitespace-nowrap rounded border bg-transparent px-2 py-1 text-sm font-semibold text-gray-700 hover:border-transparent hover:text-white"
  name="{{ $attributes["name"] }}"
  value="{{ $attributes["value"] }}"
  @isset($attributes["formaction"])
      formaction="{{ $attributes["formaction"] }}"
  @endisset()
  onclick="{{ $attributes["onclick"] }}"
>
  {{ $slot }}
</button>
