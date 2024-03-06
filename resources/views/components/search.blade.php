<form>
  <div class="inline-flex h-8 gap-2 rounded-full lg:w-fit">
    <div class="inline-flex">
      <input
        type="text"
        placeholder="Search"
        class="h-8 w-full rounded-l-xl p-1 pl-2 lg:w-56 dark:bg-gray-600 dark:text-gray-200"
        name="search"
        id="search"
        value="{{ request("search") }}"
        title="Search for a post"
      />
      <button
        type="submit"
        class="h-8 w-8 rounded-r-xl bg-gray-300 px-2 transition-all hover:bg-indigo-800 hover:fill-white dark:bg-blue-600 dark:hover:bg-blue-400"
        title="Search for a post"
      >
        <x-layout.SVG.search-icon />
      </button>
    </div>

    <label for="genre" class="sr-only">Genre</label>
    <select
      class="h-8 w-full rounded-xl p-1 pl-2 lg:w-48 dark:bg-gray-600 dark:text-gray-200"
      id="genre"
      name="genre"
      onchange="this.form.submit()"
      title="Select a genre"
    >
      <option value="">Genres</option>
      @foreach ($genres as $genre)
        @if (request("genre") == $genre->id)
          <option value="{{ $genre->id }}" selected>
            {{ $genre->name }}
          </option>
        @else
          <option value="{{ $genre->id }}">
            {{ $genre->name }}
          </option>
        @endif
      @endforeach
    </select>
    <button
      type="submit"
      class="inline-flex h-8 items-center gap-2 rounded-xl bg-gray-300 px-2 transition-all hover:bg-indigo-800 hover:fill-white dark:bg-blue-600 dark:hover:bg-blue-400"
      title="Search for a post"
    >
      <x-layout.SVG.search-icon />
      Search
    </button>
  </div>
</form>
