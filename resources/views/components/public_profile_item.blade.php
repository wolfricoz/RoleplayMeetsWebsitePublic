@if ($show)
  <article>
    <h1 class="font-bold">{{ $label }}:</h1>
    <p class="block text-sm">
      {{ $slot }}
    </p>
  </article>
@endif
