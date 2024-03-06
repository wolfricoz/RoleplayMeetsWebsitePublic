<div
  class="w-full rounded-xl border border-gray-200 bg-gray-100 dark:bg-slate-600 dark:text-gray-200 dark:border-gray-700"
  x-data="{ display: true }"
>
  <div
    class="flex flex-row justify-between rounded-xl bg-gray-200 p-2 hover:cursor-pointer hover:bg-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:border-gray-500 dark:hover:text-gray-100"
    x-on:click="display = !display"
  >
    <h6 class="text-lg font-bold">
      #{{ $rule->position }} {{ $rule->title }}
      <span class="hidden lg:block rounded-full bg-gray-100 px-2 text-xs text-gray-400">
        Click to hide/show
      </span>
    </h6>
    @if (Route::is("admin.rules"))
      <div class="mr-4 inline-flex gap-1">
        @if ($rule->position !== 1)
          <form
            method="POST"
            action="{{ route("admin.rules.update", $rule) }}"
          >
            @csrf
            @method("PATCH")
            <input type="hidden" name="up" value="true" />
            <x-admin-layout.cms_form_button>Up</x-admin-layout.cms_form_button>
          </form>
        @endif

        @if ($rule->position !== $count)
          <form
            method="POST"
            action="{{ route("admin.rules.update", $rule) }}"
          >
            @csrf
            @method("PATCH")
            <input type="hidden" name="down" value="true" />
            <x-admin-layout.cms_form_button>
              Down
            </x-admin-layout.cms_form_button>
          </form>
        @endif

        <createmodal :title="'{{ "Edit Rule" }}'" :button="'{{ "Edit" }}'">
          <form
            action="{{ route("admin.rules.update", $rule) }}"
            method="POST"
          >
            @csrf
            @method("PATCH")
            <label for="title" class="font-bold">Rule Name</label>
            <input
              id="title"
              name="title"
              type="text"
              class="w-full rounded-lg border-2 border-gray-400"
              value="{{ old("title", $rule->title) }}"
            />
            <summernote
              :name="'content'"
              :maxlength="2000"
              :value="'{{ old("content", $rule->content) }}'"
              :id="'{{ $rule->id }}'"
            ></summernote>
            <x-admin-layout.cms_form_button>
              Submit
            </x-admin-layout.cms_form_button>
          </form>
        </createmodal>
        <form method="POST" action="{{ route("admin.rules.delete", $rule) }}">
          @csrf
          @method("DELETE")
          <x-admin-layout.cms_form_button>
            Delete
          </x-admin-layout.cms_form_button>
        </form>
      </div>
    @endif
  </div>
  <article
    class="overflow-hidden p-2"
    x-show="display"
    x-transition
    x-transition.duration.700ms
  >
    {!! clean($rule->content) !!}
  </article>
</div>
