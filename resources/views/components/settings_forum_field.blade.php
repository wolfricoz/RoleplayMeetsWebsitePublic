<div class="my-2 w-full">
  <div class="inline-flex">
    <p class="w-36 font-bold">{{ $slot }}</p>

    @isset($toggle)
      <label
        class="inline-flex cursor-pointer items-center rounded-md dark:text-gray-800"
      >
        <input
          name="show_{{ $attributes["name"] }}"
          type="checkbox"
          class="peer hidden"
          {{ $toggle ? "checked" : "" }}
        />
        <span class="rounded-l-md bg-green-500 px-4 peer-checked:bg-gray-500">
          Hidden
        </span>
        <span class="rounded-r-md bg-gray-500 px-4 peer-checked:bg-blue-400">
          Public
        </span>
      </label>
    @else
      
    @endisset()
  </div>

  <label>
    <input
      type="{{ $attributes["type"] ?? "text" }}"
      name="{{ $attributes["name"] }}"
      value="{{ $attributes["value"] }}"
      min="{{ $attributes["min"] ?? "" }}"
      max="{{ $attributes["type"] === "date" ? now()->subYears(13)->format("Y-m-d") : "" }}"
      placeholder="{{ ($attributes["type"] ?? "text") === "text" ? "Enter your " . $slot : "Select your " . $slot }}"
      class="mt-1 block w-full rounded-xl shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-600"
    />
  </label>
</div>
