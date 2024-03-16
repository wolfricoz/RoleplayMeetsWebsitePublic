<div
  class="l w-full items-center gap-2 lg:inline-flex lg:h-12 lg:w-fit lg:space-y-0 lg:p-0"
>
  <form
    class="l w-full items-center gap-2 space-y-1 p-3 lg:inline-flex lg:h-12 lg:w-fit lg:space-y-0 lg:p-0"
  >
    <input
      type="text"
      placeholder="Search"
      class="h-9 w-full rounded-xl p-1 pl-2 lg:w-56 dark:bg-gray-600 dark:text-gray-200"
      name="search"
      id="search"
      value="{{ request("search") }}"
      title="Search for a post"
    />
    <div class="flex h-fit min-w-56 items-center lg:h-12 lg:w-96">
      <multisearch
        :values="{{ json_encode($genres, JSON_THROW_ON_ERROR) }}"
        :selected="{{ json_encode(explode(",", request("genre")), JSON_THROW_ON_ERROR) }}"
        :name="'genre'"
      />
    </div>
    @auth()
      <select
        name="nsfw"
        class="h-9 w-full rounded-xl p-1 pl-2 lg:w-24 dark:bg-gray-600 dark:text-gray-200"
      >
        @foreach ($post_types as $option)
          <option
            value="{{ $option }}"
            {{ request("nsfw", optional(auth()->user()->settings)->nsfw) === $option ? "selected" : "" }}
          >
            {{ $option }}
          </option>
        @endforeach
      </select>
    @endauth

    <button
      type="submit"
      class="inline-flex h-8 w-full items-center gap-2 rounded-xl bg-gray-300 px-2 transition-all hover:bg-indigo-800 hover:fill-gray-200 lg:w-fit dark:bg-blue-600 dark:hover:bg-blue-400 dark:hover:text-gray-200"
      title="Search for a post"
    >
      <x-layout.SVG.search-icon />
      Search
    </button>
  </form>
</div>
