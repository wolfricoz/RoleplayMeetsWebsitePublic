<x-admin-layout.header>
  <div id="app" class="m-5 rounded-xl bg-gray-100 p-4">
    <div class="">
      <div class="grid grid-cols-3 gap-4 border-b border-gray-300">
        <div class="col-span-1 p-2">
          <createmodal
            :title="'{{ "Create Category" }}'"
            :button="'{{ "Create Category" }}'"
          >
            <form action="{{ route("admin.genres.store") }}" method="POST">
              @csrf
              @method("PUT")
              <label for="name" class="font-bold">Genre Name</label>
              <input
                id="name"
                name="name"
                type="text"
                class="my-2 w-full rounded-lg border-2 border-gray-400"
              />
              <x-admin-layout.cms_form_button>
                Submit
              </x-admin-layout.cms_form_button>
            </form>
          </createmodal>
        </div>
        <div class="col-span-1 text-center">
          <h1 class="text-xl font-bold">Categories</h1>
          <h6 class="text-sm">Manage the categories for the site here.</h6>
        </div>
        <div class="col-span-1"></div>
      </div>
      <div class="grid grid-cols-6 gap-4 p-4">
        @forelse ($genres as $category)
          <div class="col-span-1 rounded-xl border border-gray-200 p-2">
            <h1 class="text-center font-bold">
              {{ $category->name }}
            </h1>
            <article>
              <p>Posts: {{ count($category->Posts) }}</p>
              <div class="flex justify-between">
                <createmodal
                  :title="'{{ "Edit Category" }}'"
                  :button="'{{ "Edit" }}'"
                >
                  <form
                    action="{{ route("admin.genres.update", $category) }}"
                    method="POST"
                  >
                    @csrf
                    @method("PATCH")
                    <label for="name" class="font-bold">Genre Name</label>
                    <input
                      id="name"
                      name="name"
                      type="text"
                      class="my-2 w-full rounded-lg border-2 border-gray-400"
                    />
                    <x-admin-layout.cms_form_button>
                      Submit
                    </x-admin-layout.cms_form_button>
                  </form>
                </createmodal>
                <form
                  action="{{ route("admin.genres.delete", $category) }}"
                  method="POST"
                >
                  @csrf
                  @method("DELETE")
                  <x-admin-layout.cms_form_button
                    onclick="return confirm('are you certain you want to remove this category? It will set all to null.')"
                  >
                    Delete
                  </x-admin-layout.cms_form_button>
                </form>
              </div>
              <p class="text-right text-xs">
                created: {{ $category->created_at->diffForHumans() }}
              </p>
            </article>
          </div>
        @empty
          No categories yet!
        @endforelse()
      </div>
    </div>
  </div>
</x-admin-layout.header>
