<x-layout.header>
  <div id="app" class="m-1 flex justify-center lg:m-4">
    <div
      class="h-fit  w-full rounded-xl bg-gray-100 p-4 lg:w-2/3 dark:bg-gray-700 dark:text-gray-200"
    >
        <h1 class="text-center text-2xl">Report a post</h1>
        <form method="post" action="{{ route("posts.report.store", $post) }}" x-data="{ title: '{{ old("title") }}'}" class="space-y-2">
          @csrf
          <label for="reason" class="text-sm font-bold">* Reason</label>
          <select
            name="reason"
            id="reason"
            class="mt-1 block h-9 w-full rounded-xl px-2 p-1 dark:bg-gray-600 dark:text-gray-200"
            required
            >
            @foreach($report_reasons as $reason)
              <option value="{{ $reason }}" {{ old("reason") === $reason ? "selected" : "" }}>
                {{ $reason }}
              </option>

            @endforeach
          </select>
          <h1 class="text-sm font-bold">Extra Info</h1>
          <summernote
            :maxlength="10000"
            :name="'description'"
            :value="{{ json_encode(old("content"), JSON_THROW_ON_ERROR) }}"
          ></summernote>
          <div class="flex flex-row justify-between">
            <a
              href="{{ route("home") }}"
              class="mt-2 rounded-xl bg-red-600 p-2 text-white hover:bg-red-400"
            >
              Cancel
            </a>

            <button
              type="submit"
              class="mt-2 rounded-xl bg-blue-600 p-2 text-white hover:bg-blue-400"
            >
              Create
            </button>
          </div>
          <p class="pt-2 text-sm text-gray-500">
            By submitting this post, you agree to the <a href="{{ route("tos") }}" class="text-blue-600 hover:text-blue-400 hover:underline">terms of service</a> and you acknowledge that the information you've provided is factual. If you
            report a post that is not in violation of the terms of service or rules, we reserve the right to take action against your account.
          </p>
          @if ($errors->any())
            <div class="text-red-500">
              <ul>
                @foreach ($errors->all() as $error)
                  <li class="text-sm text-red-500">
                    {{ $error }}
                  </li>
                @endforeach
              </ul>
            </div>
          @endif
        </form>

    </div>
  </div>
  <div class="h-60"></div>
</x-layout.header>
