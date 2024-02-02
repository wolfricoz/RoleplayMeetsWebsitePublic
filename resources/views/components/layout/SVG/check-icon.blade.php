@if ($post->approved)
  <span
    class="h6 h-6 cursor-default rounded-full bg-green-400 px-1.5"
    title="Approved"
  >
    Approved
  </span>
@else
  <span
    class="h-6 cursor-default rounded-full bg-red-400 px-1.5"
    title="Not approved"
  >
    Awaiting approval
  </span>
@endif
