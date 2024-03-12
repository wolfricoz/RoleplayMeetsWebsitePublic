<x-layout.header>
  <div id="app" class="m-1 flex justify-center lg:m-4">
    <div
      class="h-fit w-full rounded-xl bg-gray-100 p-4 lg:w-2/3 dark:bg-gray-700 dark:text-gray-200"
    >
      <div>
        <h1 class="text-center text-2xl">Create Post</h1>
        <form method="post" action="">
          @csrf
          @method("put")
          <label for="title">Title</label>
          <input
            type="text"
            name="title"
            id="title"
            class="w-full rounded-xl p-2 dark:bg-gray-600"
            value="{{ old("title") }}"
            required
          />
          {{-- @error('title') --}}
          <h1>Body</h1>
          <summernote
            :maxlength="10000"
            :name="'content'"
            :value="{{ json_encode(old("content"), JSON_THROW_ON_ERROR) }}"
          ></summernote>
          <div class="my-3 flex flex-col gap-4 lg:flex-row">
{{--            <div class="w-36">--}}
{{--              <label for="genre">Genre</label>--}}
{{--              <select--}}
{{--                name="genre_id"--}}
{{--                id="genre"--}}
{{--                class="w-full rounded-xl p-2 dark:bg-gray-600"--}}
{{--                required--}}
{{--              >--}}
{{--                @foreach ($genres as $genre)--}}
{{--                  <option value="{{ $genre->id }}">--}}
{{--                    {{ $genre->name }}--}}
{{--                  </option>--}}
{{--                @endforeach--}}
{{--              </select>--}}
{{--            </div>--}}
            <div class="w-36">
              <label for="charage" class="">Min. Character age</label>
              <br />
              <input
                type="number"
                name="charage"
                id="charage"
                class="w-full rounded-xl p-2 dark:bg-gray-600"
                value="{{ old("charage") }}"
                placeholder="18+"
                required
              />
            </div>
            <div class="w-36">
              <label for="partnerage">Min. Partner age</label>
              <input
                type="number"
                name="partnerage"
                id="partnerage"
                class="w-full rounded-xl p-2 dark:bg-gray-600"
                placeholder="18+"
                value="{{ old("partnerage") }}"
                required
              />
            </div>
            <div class="w-full lg:w-96 h-24">
            <multiselectrole
              :values="{{ json_encode($genres, JSON_THROW_ON_ERROR) }}"
              :selected="{{ json_encode(old("genres"), JSON_THROW_ON_ERROR) }}"
              :name="'genres_list'"
              :title="'Genres'"
              :max="5"
            />

            </div>
          </div>

          <button
            type="submit"
            class="mt-2 rounded-xl bg-blue-600 p-2 text-white hover:bg-blue-400"
          >
            Create
          </button>
          @if ($errors->any())
            <div class="text-red-500">
              <ul>
                @foreach ($errors->all() as $error)
                  <li class="text-sm text-red-500">
                    {{ $error }}
                  </li>
                @endforeach
              </ul>
            </div>
          @endif
        </form>
      </div>
    </div>
  </div>
  <div class="h-60"></div>
</x-layout.header>
