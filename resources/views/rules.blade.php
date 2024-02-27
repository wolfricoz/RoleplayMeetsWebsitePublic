<x-layout.header>
  <div id="app" class="m-6 grid grid-cols-1 gap-4" x-data="">
    <div
      class="col-span-1 rounded-xl bg-gray-100 p-6 text-center text-xl font-bold dark:bg-gray-700 dark:text-gray-200"
    >
      Rules and Guidelines
    </div>
    @forelse ($rules as $rule)
      <x-rule :rule="$rule" :count="$rules->count()"></x-rule>
    @empty
      <div class="col-span-1 rounded-xl bg-gray-100 p-6 text-center font-bold dark:bg-gray-700 dark:text-gray-200">
        Check back soon!
      >
        Check back soon!
      </div>
    @endforelse
  </div>
</x-layout.header>
