<a
  class="transition-all flex h-full w-48 cursor-pointer items-center justify-center whitespace-nowrap rounded-xl bg-blue-600 bg-transparent py-1 text-sm font-semibold text-gray-700 hover:border-transparent hover:bg-indigo-900 hover:text-white dark:text-gray-200 dark:bg-blue-600 dark:hover:bg-blue-400"
  @isset($attributes["href"])
      href="{{ $attributes["href"] }}"
  @endisset
>
  {{ $slot }}
</a>
