<x-admin-layout.header>
  <div id="app" class="m-5 rounded-xl bg-gray-100 p-4">
    <div class="grid grid-cols-4 gap-4">
      <div class="col-span-4 grid grid-cols-3 gap-4 border-b border-gray-300">
        <div class="col-span-1"></div>
        <div class="col-span-1 text-center">
          <h1 class="text-xl font-bold">Users</h1>
          <h6 class="text-sm">
            Manage users and their roles. Click on the profiles for more
            information
          </h6>
        </div>
        <div class="col-span-1"></div>
      </div>

      @forelse ($users as $user)
        <a href="{{ route("admin.users.show", $user) }}">
          <div
            class="col-span-1 rounded-xl border border-gray-300 hover:cursor-pointer hover:bg-indigo-300"
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

                <h6>Roles:</h6>
                <p>
                  @forelse ($user->getRoleNames() as $role)
                    @if (! $loop->last)
                      {{ $role }},
                    @else
                      {{ $role }}
                    @endif
                  @empty
                    No Roles
                  @endforelse
                </p>
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
        <div class="col-span-3 text-center font-bold">No Users Found</div>
      @endforelse
    </div>
  </div>
</x-admin-layout.header>
