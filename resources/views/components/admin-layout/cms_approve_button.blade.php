@if (Route::is(["admin.posts", "admin.queue"]))
  <div class="inline-flex space-x-1 pb-1">
    @if ($post->approved)
      <form action="{{ route("admin.approve", $post) }}" method="post">
        @csrf
        <x-admin-layout.cms_form_button
          name="disapprove"
          value="false"
          class="w-full border-red-700 text-left hover:bg-red-600"
          title="Disapprove the post and make it invisible to the public"
        >
          Disapprove
        </x-admin-layout.cms_form_button>
      </form>
    @else
      <form action="{{ route("admin.approve", $post) }}" method="post">
        @csrf
        <x-admin-layout.cms_form_button
          name="approve"
          value="true"
          class="w-full border-green-700 text-left hover:bg-green-600"
          title="Approve the post and make it visible to the public"
        >
          Approve
        </x-admin-layout.cms_form_button>
      </form>
      <createmodal :button="'Deny'" :title="'Deny reason'">
        <form method="POST" action="{{ route("admin.reject", $post) }}">
          @csrf
          <label>
            <textarea
              class="h-24 w-full rounded-md border-2 border-gray-300 p-2"
              name="reason"
              id="reason"
              placeholder="Reason for denial"
              required
            ></textarea>
          </label>
          <x-admin-layout.cms_form_button
            class="w-32 border-red-700 text-left hover:bg-red-600"
            title="Deny the post and make it invisible to the public"
            onclick="return confirm('Are you sure you want to deny this post?')"
          >
            Confirm
          </x-admin-layout.cms_form_button>
        </form>
      </createmodal>
    @endif
  </div>
@endif
