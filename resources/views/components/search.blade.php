<form>
  <div
    class="gap-2 space-y-1 rounded-full p-1 lg:inline-flex l items-center lg:h-12 lg:w-fit lg:space-y-0 lg:p-0"
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

{{--    <label for="genre" class="sr-only">Genre</label>--}}
{{--    <select--}}
{{--      class="h-8 w-full rounded-xl p-1 pl-2 lg:w-48 dark:bg-gray-600 dark:text-gray-200"--}}
{{--      id="genre"--}}
{{--      name="genre"--}}
{{--      --}}{{-- onchange="this.form.submit()" --}}
{{--      title="Select a genre"--}}
{{--    >--}}
{{--      <option value="">All Genres</option>--}}
{{--      @foreach ($genres as $genre)--}}
{{--        @if (request("genre") === $genre->id)--}}
{{--          <option value="{{ $genre->id }}" selected>--}}
{{--            {{ $genre->name }}--}}
{{--          </option>--}}
{{--        @else--}}
{{--          <option value="{{ $genre->id }}">--}}
{{--            {{ $genre->name }}--}}
{{--          </option>--}}
{{--        @endif--}}
{{--      @endforeach--}}
{{--    </select>--}}
    <div class="flex items-center h-fit lg:h-12 min-w-56 lg:w-96">

      <multisearch
        :values="{{ json_encode($genres, JSON_THROW_ON_ERROR) }}"
        :selected="{{ json_encode(explode(",", request('genre')), JSON_THROW_ON_ERROR) }}"
        :name="'genre'"
      />
    </div>


    <button
      type="submit"
      class="inline-flex lg:w-fit w-full h-8 items-center gap-2 rounded-xl bg-gray-300 px-2 transition-all hover:bg-indigo-800 hover:fill-gray-200 dark:bg-blue-600 dark:hover:bg-blue-400 dark:hover:text-gray-200"
      title="Search for a post"
    >
      <x-layout.SVG.search-icon />
      Search
    </button>
  </div>
</form>
