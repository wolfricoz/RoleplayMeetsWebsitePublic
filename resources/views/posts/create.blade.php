<x-layout.header>
  <div id="app" class="m-1 flex justify-center lg:m-4">
    <div
      class="h-fit w-full rounded-xl bg-gray-100 p-4 lg:w-2/3 dark:bg-gray-700 dark:text-gray-200"
    >
      <div>
        <h1 class="text-center text-2xl">Create Post</h1>
        <form method="post" action="" x-data="{ title: '{{ old("title") }}' }">
          @csrf
          @method("put")
          <label for="title" class="text-sm font-bold">* Title</label>
          <input
            type="text"
            name="title"
            id="title"
            class="w-full rounded-xl p-2 dark:bg-gray-600"
            x-model="title"
          />
          <p class="text-right text-xs text-gray-500"><span x-text="title.length"></span>/60 characters</p>
          {{-- @error('title') --}}
          <h1 class="text-sm font-bold">* Body</h1>
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
            <div class="w-40">
              <label for="charage" class="font-bold text-sm">* Min. Character age</label>
              <br/>
              <input
                type="number"
                name="charage"
                id="charage"
                class="mt-1 h-9 w-full rounded-xl p-2 dark:bg-gray-600"
                value="{{ old("charage") }}"
                placeholder="18+"
                required
              />
            </div>
            <div class="w-40">
              <label for="partnerage" class="font-bold text-sm">* Min. Partner age</label>
              <input
                type="number"
                name="partnerage"
                id="partnerage"
                class="mt-1 h-9 w-full rounded-xl p-2 dark:bg-gray-600"
                placeholder="18+"
                value="{{ old("partnerage") }}"
                required
              />
            </div>
            <div class="w-40">
              <label for="nsfw" class="font-bold text-sm">* NSFW</label>
              <select
                id="nsfw"
                name="nsfw"
                class="block h-9 p-2 mt-1 rounded-xl dark:bg-gray-600 dark:text-gray-200 w-full"
                required
              >
                @foreach($post_types as $option)
                  @if ($option !== "all")
                  <option value="{{ $option }}" {{ old("nsfw", auth()->user()->settings->nsfw) === $option ? "selected" : "" }}>
                  {{ $option }}
                  @endif
                @endforeach
              </select>

            </div>

            <div class="w-full lg:w-96">
              <multiselectrole
                :values="{{ json_encode($genres, JSON_THROW_ON_ERROR) }}"
                :selected="{{ json_encode(explode(",", old("genres_list")), JSON_THROW_ON_ERROR) }}"
                :name="'genres_list'"
                :title="'Genres'"
                :max="5"
              />

            </div>
          </div>

          <div class="flex flex-row justify-between">
            <a href="{{ route('home') }}"
               class="mt-2 rounded-xl bg-red-600 p-2 text-white hover:bg-red-400"
            >
              Cancel
            </a>

            <button
              type="submit"
              class="mt-2 rounded-xl bg-blue-600 p-2 text-white hover:bg-blue-400"
            >
              Create
            </button>
          </div>
          <article class="text-sm text-gray-500 text-center">
            By creating a post, you agree to the <a href="{{ route('tos') }}" class="text-blue-600">Terms of Service</a> and <a href="{{ route('rules') }}" class="text-blue-600">rules</a>.
          </article>

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
