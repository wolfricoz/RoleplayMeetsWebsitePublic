<a
  class="transition-all bg-blue-600 flex h-full w-48 cursor-pointer items-center justify-center
  whitespace-nowrap rounded-xl py-1 text-sm font-semibold
  hover:border-transparent hover:text-white
  dark:text-gray-200 hover:bg-blue-400"
  @isset($attributes["href"])
    href="{{ $attributes["href"] }}"
  @endisset
>
  {{ $slot }}
</a>
