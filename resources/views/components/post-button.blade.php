<a
  class="flex h-12 w-full cursor-pointer items-center justify-center whitespace-nowrap rounded-xl bg-blue-600 py-1 text-sm font-semibold transition-all hover:border-transparent hover:bg-blue-400 hover:text-white lg:h-full lg:w-48 dark:text-gray-200"
  @isset($attributes["href"])
      href="{{ $attributes["href"] }}"
  @endisset
>
  {{ $slot }}
</a>
