<div class="space-x-1">
  @if ($post->nsfw)
    <span
      class="h6 h-6 cursor-default rounded-full bg-red-400 px-1.5 text-sm"
      title="Not Safe For Work"
    >
      NSFW
    </span>
  @else
    <span
      class="h-6 cursor-default rounded-full bg-indigo-400 px-1.5 text-sm"
      title="Safe For Work"
    >
      SFW
    </span>
  @endif
  @if ($post->approved)
    <span
      class="h6 h-6 cursor-default rounded-full bg-green-400 px-1.5 text-sm"
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
</div>
