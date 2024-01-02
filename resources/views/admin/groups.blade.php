@php use function Webmozart\Assert\Tests\StaticAnalysis\lower; @endphp
<x-admin-layout.header>
    <div id="app" class="m-5 bg-gray-100 p-4 rounded-xl text-center">
        <div class="grid grid-cols-12 space-y-2 gap-2">
            @foreach(["name", "Dashboard", "Manage Posts", "Manage Users", "Manage Rules", "Manage Genres", "Manage Groups", "Manage Roles", "Manage Settings", "Patron"] as $item)
                <div class="col-span-1 font-bold">{{ $item }}</div>
            @endforeach
            <div class="col-span-2">
                New Group
            </div>

            <div class="col-span-12 border-b border-gray-300 p-1"></div>

            @foreach($groups as $group)
                    @if($group->name === "Admin")
                        <div class="col-span-1 pt-1">{{ $group->name }}</div>
                        <div class="col-span-11 font-bold "> The admin group can not be edited.</div>
                    @else
                <form action="{{ route('admin.groups.update') }}" method="POST"
                      class="col-span-11 grid grid-cols-11 gap-2">
                    @csrf

                        <div class="col-span-1 pt-1">{{ $group->name }}</div>
                        <input name="access_dashboard" class="col-span-1 m-auto"
                               type="checkbox" {{ $group->access_dashboard ? 'checked' : '' }} />
                        <input name="manage_posts" class="col-span-1 m-auto"
                                 type="checkbox" {{ $group->manage_posts ? 'checked' : '' }}/>
                        <input name="manage_users" class="col-span-1 m-auto"
                               type="checkbox" {{ $group->manage_users ? 'checked' : '' }}/>
                        <input name="manage_rules" class="col-span-1 m-auto"
                               type="checkbox" {{ $group->manage_rules ? 'checked' : '' }}/>
                        <input name="manage_genres" class="col-span-1 m-auto"
                               type="checkbox" {{ $group->manage_genres ? 'checked' : '' }}/>
                        <input name="manage_groups" class="col-span-1 m-auto"
                               type="checkbox" {{ $group->manage_groups ? 'checked' : '' }}/>
                        <input name="manage_roles" class="col-span-1 m-auto"
                               type="checkbox" {{ $group->manage_roles ? 'checked' : '' }}/>
                        <input name="manage_settings" class="col-span-1 m-auto"
                               type="checkbox" {{ $group->manage_settings ? 'checked' : '' }}/>
                        <input name="is_patron" class="col-span-1 m-auto"
                               type="checkbox" {{ $group->is_patron ? 'checked' : '' }}/>
                        <x-admin-layout.cms_form_button name="id" value="{{ $group->id }}"
                                                        class="border-green-700 text-green-800 hover:bg-green-500">
                            Update
                        </x-admin-layout.cms_form_button>
                </form>

                <form class="col-span-1" method="POST">
                    @method('DELETE')
                    @csrf
                    <x-admin-layout.cms_form_button name="id"
                                                    class="border-red-700 text-red-800  hover:bg-red-600"
                                                    value="{{ $group->id }}">
                        Delete
                    </x-admin-layout.cms_form_button>
                </form>

                @endif

            @endforeach()
        </div>
        {{ $groups->links() }}
        <div class="text-sm text-left mt-10">
            Potential Layout:
            Make a drop down with permissions which can be added to a group, the admin can choose multiple permissions, and they are then added to the group. This can scale to any number of permissions. Potentially with: <a href="https://github.com/vueform/multiselect#using-with-vue-3" class="text-blue-900">this</a>
        </div>
    </div>
</x-admin-layout.header>
