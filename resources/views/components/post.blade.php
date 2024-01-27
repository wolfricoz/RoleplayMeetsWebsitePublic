@php
  use Carbon\Carbon;
@endphp

<div
  class="w-full rounded-xl bg-gray-100"
  x-bind:class="{
    'col-span-1': layout === 'grid',
    'col-span-3': layout === 'list'
  }"
>
  <div
    class="grid h-10 w-full grid-cols-3 overflow-hidden border-b border-gray-200 p-2"
  >
    <div class="inline-flex col-span-1">
      @auth()
        <dropdown :post="{{ json_encode($post, JSON_THROW_ON_ERROR) }}">
          @if ($post->user_id === auth()->user()->id)
            <x-post_dropdown_button>
              @if ($post->bumped_at === null || Carbon::parse($post->bumped_at)->addMinutes(1440) <= Carbon::now())
                <form action="{{ route("posts.bump", $post) }}" method="POST">
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
                  :post="{{ json_encode($post, JSON_THROW_ON_ERROR) }}"
                ></countdown>
              @endif

            </x-post_dropdown_button>

            <x-post_dropdown_button>Edit</x-post_dropdown_button>
          @endif
            @if (auth()->user()->hasPermissionTo("manage_posts"))
              <span class="text-xs border-b text-center border-gray-200">Admin Controls</span>
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
            <nsfwtoggle :post="{{ $post }}"></nsfwtoggle>
          </x-post_dropdown_button>
            @endif

          <x-post_dropdown_button>
            @if (auth()->user()->hasPermissionTo("manage_posts") ||($post->user_id === auth()->user()->id &&auth()->user()->hasPermissionTo("delete_posts")))
              <form action="{{ route("admin.delete", $post) }}" method="post">
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
    <div class="col-span-1 text-center">
      <a
        href="{{ route("posts.show", $post) }}"
        class="inline-flex text-lg hover:text-indigo-900"
        title="Go to post"
      >
        {{ $post->title }}
      </a>
    </div>
    <div class="col-span-1 flex justify-end">
      <x-layout.SVG.check-icon :post="$post"/>
    </div>
  </div>
  <div
    class="grid grid-cols-5 border-b border-gray-200 px-2 text-center text-xs lg:text-sm"
  >
    <span class="grid-cols-1 text-left">
      {!! $post->updated_at > $post->created_at ? "Updated: <br>{$post->updated_at->format("m/d/y H:i")}" : "Created:  <br>{$post->created_at->format("m/d/y H:i")}" !!}
    </span>
    <span class="grid-cols-1">
      character age:
      <br/>
      {{ $post->charage }}+
    </span>
    <span class="grid-cols-1">
      Author:
      <br/>
      <a
        class="hover:text-indigo-900 hover:underline"
        href="{{ route("users.show", $post->user_id) }}"
      >
        {{ $post->user->global_name }}
      </a>
    </span>
    <span class="grid-cols-1">
      partner Age:
      <br/>
      {{ $post->partnerage }}+
    </span>
    <span class="grid-cols-1 text-right">
      Genre:
      <br/>
      <a
        class="hover:text-indigo-900 hover:underline"
        href="{{ route("home", ["search" => request("search"), "genre" => $post->genre_id]) }}"
      >
        {{ $post->genre->name }}
      </a>
    </span>
  </div>
  <show-more :post="{{ json_encode($post, JSON_THROW_ON_ERROR) }}">
    {!! clean($post->content) !!}
  </show-more>
</div>
