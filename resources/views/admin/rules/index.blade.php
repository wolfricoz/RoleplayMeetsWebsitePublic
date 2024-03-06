<x-admin-layout.header>
  <div id="app" class="rounded-xl dark:text-gray-200 p-4">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
      <div class="col-span-1 lg:col-span-4 grid grid-cols-1 lg:grid-cols-3 gap-4 border-b border-gray-300">
        <div class="col-span-1 p-2">
          <createmodal
            :title="'{{ "Create Rule" }}'"
            :button="'{{ "Create Rule" }}'"
          >
            <form action="{{ route("admin.rules.create") }}" method="POST">
              @csrf
              @method("PUT")
              <label for="title" class="font-bold">Rule Name</label>
              <input
                id="title"
                name="title"
                type="text"
                class="w-full rounded-lg border-2 border-gray-400"
              />
              <summernote
                :name="'content'"
                :maxlength="2000"
                :value="'{{ old("content") }}'"
              ></summernote>
              <x-admin-layout.cms_form_button>
                Submit
              </x-admin-layout.cms_form_button>
            </form>
          </createmodal>
        </div>
        <div class="col-span-1 text-center">
          <h1 class="text-xl font-bold">Rules</h1>
          <h6 class="text-sm">Manage the rules for the site here.</h6>
        </div>
        <div class="col-span-1"></div>
      </div>
      <div class="col-span-1 flex flex-col gap-4 lg:col-span-4">
        @forelse ($rules as $rule)
          <x-rule :rule="$rule" :count="$rules->count()"></x-rule>
        @empty
          No rules yet!
        @endforelse
      </div>
    </div>
  </div>
</x-admin-layout.header>
