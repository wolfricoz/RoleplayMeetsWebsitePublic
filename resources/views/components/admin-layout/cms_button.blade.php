@if ($permission)
  <a href="{{ $attributes["href"] }}">
    <div
      class="flex w-full justify-between p-4 text-sm font-semibold hover:border-r border-blue-600 hover:bg-gray-100 hover:text-indigo-900 dark:hover:text-blue-400 dark:hover:bg-zinc-700"
    >
      <span>
        {{ $slot }}
      </span>
      @isset($display)
        <span
          class="h-5 w-10 overflow-hidden rounded-full bg-indigo-800 text-center text-white"
        >
          {{ $display }}
        </span>
      @endisset
    </div>
  </a>
@endif()
