@if ($permission)
  <a href="{{ $attributes["href"] }}">
    <div
      class="flex items-center w-full justify-between p-3 text-sm font-semibold hover:border-r border-blue-600 hover:bg-gray-100 hover:text-indigo-900
      dark:border-blue-600
  dark:bg-zinc-800 dark:fill-blue-400 dark:text-gray-200 dark:hover:bg-zinc-600 dark:hover:fill-blue-600
  dark:hover:text-blue-400"
    >
      <span>
        {{ $icon }}
      </span>
      <span class="w-full text-left pl-2 font-bold"
        x-show="open"
      >
        {{ $slot }}
      </span>
      @isset($display)
        <span
          class="h-5 w-12 overflow-hidden rounded-full bg-indigo-800 text-center text-white"
          x-show="open"
        >
          {{ $display }}
        </span>
      @else
        <span class="h-5 w-12">

        </span>
      @endisset
    </div>
  </a>
@endif()
