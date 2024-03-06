<a
  class="my-1 inline-flex w-full border-gray-200 fill-stone-600 p-3 text-gray-700 transition-all ease-in-out
  hover:cursor-pointer hover:border-r hover:bg-gray-50 hover:fill-indigo-900 hover:text-black dark:border-blue-600
  dark:bg-zinc-800 dark:fill-blue-400 dark:text-gray-200 dark:hover:bg-zinc-600 dark:hover:fill-blue-600
  dark:hover:text-blue-400"
  href="{{ $attributes["href"] }}"
>
  <span class="my-auto items-center justify-center transition-all">
    {{ $icon }}
  </span>
  <span class="ml-2 font-bold" x-show="open">
    {{ $slot }}
  </span>
</a>
