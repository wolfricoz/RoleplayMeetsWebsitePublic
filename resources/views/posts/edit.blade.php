<x-layout.header>
  <div id="app" class="m-1 flex justify-center lg:m-4">
    <div class="h-fit w-full rounded-xl bg-gray-100 p-4 lg:w-2/3">
      <div>
        <h1 class="text-center text-2xl">Create Post</h1>
        <form method="post" action="{{ route("posts.update", $post) }}">
          @csrf
          @method("PATCH")
          <label for="title">Title</label>
          <input
            type="text"
            name="title"
            id="title"
            class="w-full rounded-md border border-gray-300 p-2"
            value="{{ old("title") ?? $post->title }}"
            required
          />
          <h1>Body</h1>
          <summernote
            :maxlength="10000"
            :name="'content'"
            :value="{{ json_encode(old("content") ?? $post->content, JSON_THROW_ON_ERROR) }}"
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
                  @if ($genre->id === $post->genre_id)
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
            <div class="w-36">
              <label for="charage" class="">Min. Character age</label>
              <br />
              <input
                type="number"
                name="charage"
                id="charage"
                class="w-full rounded-md border border-gray-300 p-2"
                value="{{ old("charage") ?? $post->charage }}"
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
                value="{{ old("partnerage") ?? $post->partnerage }}"
                required
              />
            </div>
          </div>

          <button
            type="submit"
            class="mt-2 rounded-md bg-indigo-900 p-2 text-white"
          >
            Update
          </button>
          <p class="pt-2 text-sm text-gray-500">
            By updating your post, it will be sent to the moderators for
            approval. If you want to simply bump your post, please use the bump
            button.
          </p>
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
