<x-admin-layout.header>
  <div id="app" class="m-5 p-4 dark:text-gray-200">
    <div class="grid grid-cols-3 gap-4">
      <div class="col-span-3 grid grid-cols-3 gap-4 border-b border-gray-300">
        <div class="col-span-1">
          <createmodal
            :button="'Create a new group'"
            :values="{{ $permissions }}"
            :title="'Create Role'"
          >
            <div class="col-span-1 border p-4">
              <x-admin-layout.cms_role_form
                action="{{route('admin.groups.store')}}"
                :permissions="$permissions"
              />
            </div>
          </createmodal>
        </div>
        <div class="col-span-1 text-center">
          <h1 class="text-xl font-bold">Roles</h1>
          <h6 class="text-sm">Manage Roles and their permissions.</h6>
        </div>
        <div class="col-span-1"></div>
      </div>

      @forelse ($roles as $role)
        <div class="col-span-1 border rounded-xl dark:bg-gray-700 p-4">
          <x-admin-layout.cms_role_form
            action="{{ route('admin.groups.update', $role) }}"
            :role="$role"
            :permissions="$permissions"
          />
        </div>
      @empty
        <div class="col-span-3 text-center font-bold">No groups yet!</div>
      @endforelse
    </div>
  </div>
</x-admin-layout.header>
