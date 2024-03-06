@php
  use Carbon\Carbon;
@endphp

<x-layout.header>
  <div class="p-2" id="app">
    <div class="gap-2 space-y-2 lg:flex lg:flex-row-reverse lg:space-y-0">
      <x-profile_sidebar :user="$user"></x-profile_sidebar>
      <div class="grid w-full grid-cols-3 gap-2 lg:gap-4">
        <div
          class="col-span-3 row-auto row-start-1 h-fit space-y-2 rounded-xl bg-gray-200 p-4 dark:bg-gray-700 dark:text-gray-200"
        >
          <div class="rounded-b-xl border-b border-gray-300">
            <h1 class="text-center text-xl font-bold">{{ $post->title }}</h1>
          </div>
          <article class="">
            {!! clean($post->content) !!}
          </article>
          <div class="flex flex-row items-center justify-end">
            <div class="flex justify-end">
              <x-layout.SVG.check-icon :post="$post" />
            </div>
            <div class="inline-flex">
              @auth()
                <dropdown
                  :post="{{ json_encode($post, JSON_THROW_ON_ERROR) }}"
                >
                  @if ($post->user_id === auth()->user()->id)
                    <x-post_dropdown_button>
                      @if ($post->bumped_at === null || Carbon::parse($post->bumped_at)->addMinutes(1440) <= Carbon::now())
                        <form
                          action="{{ route("posts.bump", $post) }}"
                          method="POST"
                        >
                          @method("PATCH")
                          @csrf
                          <button
                            type="submit"
                            title="Bump the post to the top of the list"
                            name="bump"
                            value="true"
                          >
                            Bump
                          </button>
                        </form>
                      @else
                        <countdown
                          v-bind:post="{{ json_encode($post, JSON_THROW_ON_ERROR) }}"
                        ></countdown>
                      @endif
                    </x-post_dropdown_button>

                    <x-post_dropdown_button
                      href="{{ route('posts.edit', $post) }}"
                    >
                      Edit
                    </x-post_dropdown_button>
                  @endif

                  @if (auth()->user()->hasPermissionTo("manage_posts"))
                    <span class="border-b border-gray-200 text-center text-xs">
                      Admin Controls
                    </span>
                    <x-post_dropdown_button>
                      @if ($post->approved)
                        <form
                          action="{{ route("admin.approve", $post) }}"
                          method="post"
                        >
                          @csrf
                          <button
                            type="submit"
                            class="w-full text-left text-red-500"
                            title="Disapprove the post and make it invisible to the public"
                          >
                            Disapprove
                          </button>
                        </form>
                      @else
                        <form
                          action="{{ route("admin.approve", $post) }}"
                          method="post"
                        >
                          @csrf
                          <button
                            type="submit"
                            class="w-full text-left text-red-500"
                            title="Approve the post and make it visible to the public"
                          >
                            Approve
                          </button>
                        </form>
                      @endif
                    </x-post_dropdown_button>

                    <x-post_dropdown_button>
                      <nsfwtoggle
                        v-bind:post="{{ json_encode($post, JSON_THROW_ON_ERROR) }}"
                      ></nsfwtoggle>
                    </x-post_dropdown_button>
                  @endif

                  <x-post_dropdown_button>
                    @if (auth()->user()->hasPermissionTo("manage_posts") ||($post->user_id === auth()->user()->id &&auth()->user()->hasPermissionTo("delete_posts")))
                      <form
                        action="{{ route("admin.delete", $post) }}"
                        method="post"
                      >
                        @method("delete")
                        @csrf
                        <button
                          type="submit"
                          onclick="confirm('Are you sure you want to reject and delete this post?')"
                          class="w-full text-left text-red-500"
                          title="Delete the post"
                        >
                          Delete
                        </button>
                      </form>
                    @endif
                  </x-post_dropdown_button>
                </dropdown>
                <x-admin-layout.cms_approve_button :post="$post" />
              @endauth
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-layout.header>
