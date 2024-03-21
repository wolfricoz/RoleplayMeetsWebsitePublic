<x-layout.header>
  <div id="app" class="m-1 flex justify-center lg:m-4">
    <div
      class="h-fit w-full rounded-xl bg-gray-100 p-4 lg:w-2/3 dark:bg-gray-700 dark:text-gray-200"
    >
      <div>
        <h1 class="text-center text-2xl">Create Post</h1>
        <form
          method="post"
          action="{{ route("posts.update", $post) }}"
          x-data="{ title: '{{ old("title") ?? $post->title }}' }"
        >
          @csrf
          @method("PATCH")
          <label for="title" class="text-sm font-bold">*Title</label>
          <input
            type="text"
            name="title"
            id="title"
            x-model="title"
            class="w-full rounded-xl p-2 dark:bg-gray-600"
            required
          />
          <p class="text-right text-xs text-gray-500">
            <span x-text="title.length"></span>
            /60 characters
          </p>
          <h1 class="text-sm font-bold">*Body</h1>
          <summernote
            :maxlength="10000"
            :name="'content'"
            :value="{{ json_encode(old("content") ?? $post->content, JSON_THROW_ON_ERROR) }}"
          ></summernote>
          <div class="my-3 flex flex-col gap-4 lg:flex-row">
            <div class="w-40">
              <label for="charage" class="text-sm font-bold">
                *Min. Character age
              </label>
              <br/>
              <input
                type="number"
                name="charage"
                id="charage"
                value="{{ old("charage") ?? $post->charage }}"
                class="mt-1 h-9 w-full rounded-xl p-2 dark:bg-gray-600"
                required
              />
            </div>
            <div class="w-40">
              <label for="partnerage" class="text-sm font-bold">
                *Min. Partner age
              </label>
              <input
                type="number"
                name="partnerage"
                id="partnerage"
                value="{{ old("partnerage") ?? $post->partnerage }}"
                class="mt-1 h-9 w-full rounded-xl p-2 dark:bg-gray-600"
                required
              />
            </div>
            <div class="w-40">
              <label for="nsfw" class="text-sm font-bold">* NSFW</label>
              <select
                id="nsfw"
                name="nsfw"
                class="mt-1 block h-9 w-full rounded-xl p-2 dark:bg-gray-600 dark:text-gray-200"
                required
              >
                @foreach ($post_types as $option)
                  @if ($option !== "all")
                    <option
                      value="{{ $option }}"
                      {{ old("nsfw", $post->nsfw) === $option ? "selected" : "" }}
                    >
                      {{ $option }}
                    </option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="h-24 w-full lg:w-96">
              <multiselectrole
                :values="{{ json_encode($genres, JSON_THROW_ON_ERROR) }}"
                :selected="{{ json_encode(old("genres_list") ? explode(",", old("genres_list")) : $post->tags()->get(), JSON_THROW_ON_ERROR) }}"
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
  <div class="h-60"></div>
</x-layout.header>
