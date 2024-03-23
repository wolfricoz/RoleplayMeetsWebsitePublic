<x-admin-layout.header>
  <div id="app" class="flex flex-col gap-4 p-4 dark:text-gray-200">
    <div
      class="grid grid-cols-1 gap-4 border-b border-gray-300 lg:col-span-4 lg:grid-cols-3"
    >
      <div class="col-span-1"></div>
      <div class="col-span-1 text-center">
        <h1 class="text-2xl font-bold">Reports</h1>
        <h6 class="text-sm">
          View and manage reports. Click on the reports for more information
        </h6>
      </div>
      <div class="col-span-1"></div>
    </div>
    @forelse ($reports as $report)
      <div class="w-full rounded-xl bg-gray-100 p-4 text-stone-800 dark:bg-gray-700 dark:text-gray-200 space-y-1">
        <div class="flex flex-row justify-between">
          <h1 class="text-2xl font-bold"> {{ $report->post->title }}</h1>
          <span class="text-sm">Author:
          <a
            href="{{ route('users.show', $report->post->user) }}"
            class="text-sm hover:text-blue-400 hover:underline"
          >
            {{ $report->post->user->global_name }}
          </a>
            </span>
        </div>
        <h6 class="text-sm">Reported by:
          <a href="{{ route('users.show', $report->user) }}" class="text-sm hover:text-blue-400 hover:underline">
            {{ $report->user->global_name }}
          </a>
        </h6>
        <h6 class="text-sm">Reason: {{ $report->reason }}</h6>

        <show-more>
          {!! clean($report->description) !!}
        </show-more>

        <form
          method="post"
          action="{{ route('admin.reports.change', $report) }}"
          class="flex flex-row justify-end"
        >
          @csrf
          @method('PATCH')
          <select
            name="status"
            id="status"
            class="h-9 w-full rounded-xl p-1 pl-2 lg:w-24 dark:bg-gray-600 dark:text-gray-200"
            onchange="this.form.submit()"
          >
            @foreach($statuses as $status)
              <option value="{{ $status }}" {{ $report->status === $status ? 'selected' : '' }}>
                {{ $status }}
              </option>
            @endforeach
          </select>
        </form>
      </div>


    @empty
      <h1 class="text-center text-2xl font-bold">There are no reports</h1>
      <h6 class="text-center">Check back later!</h6>
    @endforelse

    {{ $reports->links() }}
  </div>
</x-admin-layout.header>
