<x-layout.header>
  <div id="app" class="m-1 flex justify-center lg:m-4">
    <div class="h-fit w-full bg-gray-100 p-4 lg:w-2/3">
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
            class="w-full rounded-md border border-gray-300 p-2"
            value="{{ old("title") }}"
            required
          />
          {{-- @error('title') --}}
          <h1>Body</h1>
          <summernote
            :maxlength="10000"
            :name="'content'"
            :value="{{ json_encode(old("content")) }}"
          ></summernote>
          <div class="my-3 flex flex-col gap-4 lg:flex-row">
            <div class="w-36">
              <label for="genre">Genre</label>
              <select
                name="genre_id"
                id="genre"
                class="w-full rounded-md border border-gray-300 p-2"
                required
              >
                @foreach ($genres as $genre)
                  <option value="{{ $genre->id }}">
                    {{ $genre->name }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="w-36">
              <label for="charage" class="">Min. Character age</label>
              <br />
              <input
                type="number"
                name="charage"
                id="charage"
                class="w-full rounded-md border border-gray-300 p-2"
                value="{{ old("charage") }}"
                required
              />
            </div>
            <div class="w-36">
              <label for="partnerage">Min. Partner age</label>
              <input
                type="number"
                name="partnerage"
                id="partnerage"
                class="w-full rounded-md border border-gray-300 p-2"
                value="{{ old("partnerage") }}"
                required
              />
            </div>
          </div>

          <button
            type="submit"
            class="mt-2 rounded-md bg-indigo-900 p-2 text-white"
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
</x-layout.header>
