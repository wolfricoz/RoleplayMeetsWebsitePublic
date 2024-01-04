<form method="POST" action="{{ $attributes['action'] }}" class="space-y-2">
    @csrf
    <label for="name" class="font-bold">Role Name</label>
    <input id="name" name="name" type="text" value="{{ isset($role) ? $role->name : ''}}" placeholder="name"
           class="border-2 border-gray-400 rounded-lg w-full">
    <multiselectrole :values="{{ json_encode($permissions, JSON_THROW_ON_ERROR) }}"
                     :selected="{{ isset($role) ? json_encode($role->getAllPermissions(), JSON_THROW_ON_ERROR) : null }}"></multiselectrole>
    <input name="role_id" type="hidden" value="{{ isset($role) ? $role->id : null }}">
    @if(isset($role) && $role->name === 'Admin')
        <p class="font-bold text-center">This role can not be edited.</p>
    @else
        <div class="flex justify-between p-2">
            <x-admin-layout.cms_form_button class="border-green-700 hover:bg-green-600">Submit
            </x-admin-layout.cms_form_button>
            @isset($role)
                <x-admin-layout.cms_form_button name="" class="border-red-700 hover:bg-red-600"
                                                formaction="{{ route('admin.groups.delete', $role) }}"
                                                onclick="confirm('Are you certain you want to remove this role?')">
                    Delete
                </x-admin-layout.cms_form_button>
            @endisset()
        </div>
    @endif

</form>
