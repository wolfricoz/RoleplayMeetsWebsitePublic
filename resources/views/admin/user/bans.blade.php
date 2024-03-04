<x-admin-layout.header>
  <div id="app" class="m-5 text-gray-200 p-4">
    <div class="grid grid-cols-4 gap-4">
      <div class="col-span-4 grid grid-cols-3 gap-4 border-b border-gray-300">
        <div class="col-span-1"></div>
        <div class="col-span-1 text-center">
          <h1 class="text-xl font-bold">Bans</h1>
          <h6 class="text-sm">
            These users have been banned, you can review their bans here or
            unban them
          </h6>
        </div>
        <div class="col-span-1"></div>
      </div>

      @forelse ($users as $user)
        <a href="{{ route("admin.users.show", $user) }}">
          <div
            class="col-span-1 rounded-xl border border-gray-300 hover:cursor-pointer hover:bg-indigo-300 dark:bg-gray-700"
            title="Click to view profile"
          >
            <div class="flex flex-row p-1">
              <img
                class="h-32 w-32 rounded-full border border-gray-200 object-cover"
                src="{{ $user->getAvatar(["extension" => "webp", "size" => 512]) }}"
                alt="{{ $user->getTagAttribute() }}"
              />
              <div class="w-full p-2 text-sm">
                <h1 class="text-center text-lg">
                  {{ $user->global_name }}
                </h1>
                <h6 class="border-b border-gray-300 text-center text-xs">
                  {{ $user->username }}
                </h6>
                @isset($user->banned_at)
                  <div class="rounded-xl bg-red-500 p-1 text-white">
                    <h1 class="text-center text-sm font-bold">
                      This user is banned
                    </h1>
                  </div>
                @endisset

                <h6>Reason</h6>
                <p class="max-h-28">
                  {!! clean($user->getBans()->first()->comment) ?? "No reason provided" !!}
                </p>
                <div class="flex flex-row justify-between">
                  <div>
                    <h6>Banned At:</h6>
                    <p>
                      {!! clean($user->getBans()->first()->created_at->format("m/d/Y"),) ?? "No date provided" !!}
                    </p>
                  </div>
                  <div>
                    <h6>Expires At:</h6>
                    <p>
                      {{ optional($user->getBans()->first()->expired_at)->format("m/d/Y") ?? "No date provided" }}
                    </p>
                  </div>
                </div>

                <form
                  class="flex justify-end"
                  method="POST"
                  action="{{ route("admin.users.unban", $user) }}"
                >
                  @csrf
                  <button
                    type="submit"
                    class="rounded bg-green-500 px-4 py-2 font-bold text-white hover:bg-green-400"
                  >
                    Unban
                  </button>
                </form>
              </div>
            </div>
            <div class="mx-2 flex flex-row gap-2 text-xs">
              <span>ID: {{ $user->id }}</span>
              <span>
                Joined:
                {{ $user->created_at->format("m/d/y") }}
              </span>
            </div>
          </div>
        </a>
      @empty
        <div class="col-span-4 text-center font-bold">No Users Found</div>
      @endforelse
    </div>
  </div>
</x-admin-layout.header>
