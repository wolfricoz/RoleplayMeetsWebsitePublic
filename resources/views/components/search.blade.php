<form>
  <div class="mt-2 inline-flex h-8 rounded-full lg:w-fit">
    <input
      type="text"
      placeholder="Search"
      class="h-8 w-full rounded-l-full border border-stone-200 p-1 pl-2 lg:w-56"
      name="search"
      id="search"
      value="{{ request("search") }}"
      title="Search for a post"
    />
    <button
      type="submit"
      class="h-8 w-8 rounded-r-full bg-gray-300 px-2 hover:bg-indigo-800 hover:fill-white"
      title="Search for a post"
    >
      <x-layout.SVG.search-icon />
    </button>
    <label for="genre" class="sr-only">Genre</label>
    <select
      class="ml-4 h-8 w-full rounded-full border border-stone-200 p-1 pl-2 lg:w-48"
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
  </div>
</form>
