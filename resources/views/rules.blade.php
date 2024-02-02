<x-layout.header>
  <div id="app" class="m-6 grid grid-cols-1 gap-4" x-data="">
    <div
      class="col-span-1 rounded-xl bg-gray-100 p-6 text-center text-xl font-bold"
    >
      Rules and Guidelines
    </div>
    @forelse ($rules as $rule)
      <x-rule :rule="$rule" :count="$rules->count()"></x-rule>
    @empty
      <div class="col-span-1 rounded-xl bg-gray-100 p-6 text-center font-bold">
        Check back soon!
      </div>
    @endforelse
  </div>
</x-layout.header>
