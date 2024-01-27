@if ($post->approved)
  <span class="rounded-full bg-green-400 px-1.5 h-6 h6 cursor-default"
        title="Approved">
    Approved
</span>
@else
  <span class="rounded-full bg-red-400 px-1.5 h-6 cursor-default"
        title="Not approved">
  Awaiting approval
  </span>
@endif
