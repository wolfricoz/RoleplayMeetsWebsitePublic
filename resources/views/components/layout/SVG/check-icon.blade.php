<div class="space-x-1">
  @if ($post->nsfw === "nsfw" || $post->nsfw === "extreme")
    <span
      class="h6 h-6 cursor-default rounded-full bg-red-400 px-1.5 text-sm"
      title="Not Safe For Work"
    >
      {{ $post->nsfw }}
    </span>
  @else
    <span
      class="h-6 cursor-default rounded-full bg-indigo-400 px-1.5 text-sm"
      title="Safe For Work"
    >
      SFW
    </span>
  @endif
  @if (Route::is(["admin.*", "dashboard", "posts.show"]))
    @if ($post->approved)
      <span
        class="h6 h-6 cursor-default rounded-full bg-green-500 px-1.5 text-sm"
        title="Approved"
      >
        Approved
      </span>
    @else
      <span
        class="h-6 cursor-default rounded-full bg-red-400 px-1.5 text-sm"
        title="Not approved"
      >
        Awaiting approval
      </span>
    @endif
  @endif
</div>
