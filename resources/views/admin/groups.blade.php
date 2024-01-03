@php use function Webmozart\Assert\Tests\StaticAnalysis\lower; @endphp
<x-admin-layout.header>
    <div id="app" class="m-5 bg-gray-100 p-4 rounded-xl text-center">
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-1"></div>
            <div class="col-span-1 text-center border-b border-gray-300">
                <h1 class="text-xl font-bold">
                    Roles
                </h1>
                <h6 class="text-sm">
                    Manage Roles and their permissions.
                </h6>
            </div>
            <div class="col-span-1">
                <createmodal></createmodal>
            </div>

            @forelse($roles as $role)
                <div class="col-span-1 border p-4">
                    <h1>
                        {{ $role->name }}
                    </h1>


                        <form id="updatePermissionsForm" method="POST" action="{{ route('admin.groups.update') }}"
                              name="updatePermissions">
                            @csrf
                            <multiselect :values="{{ $permissions }}"
                                         :selected="{{ $role->getAllPermissions() }}"></multiselect>
                            <input name="role_id" type="hidden" value="{{ $role->id }}">
                            <div class="flex justify-between p-2">
                                <x-admin-layout.cms_form_button class="border-green-700 hover:bg-green-600">Submit
                                </x-admin-layout.cms_form_button>
                                <x-admin-layout.cms_form_button name="" class="border-red-700 hover:bg-red-600" formaction="{{ route('admin.groups.delete', $role) }}" onclick="confirm('Are you certain you want to remove this role?')">
                                    Delete
                                </x-admin-layout.cms_form_button>
                            </div>

                        </form>





                </div>
            @empty
                <div class="col-span-3 text-center font-bold">
                    No groups yet!
                </div>
            @endforelse
        </div>
    </div>
</x-admin-layout.header>
