<x-admin-layout.header>
    <div id="app" class="m-5 bg-gray-100 p-4 rounded-xl">
        <div class="grid grid-cols-4 gap-4">
            <div class="col-span-4 grid grid-cols-3 gap-4 border-b border-gray-300">
                <div class="col-span-1">
                    <createmodal :button="'Create new role'" :title="'Create Role'">
{{--                        <div class="col-span-1 border p-4 ">--}}
{{--                            <x-admin-layout.cms_role_form action="{{route('admin.groups.store')}}"--}}
{{--                                                          :permissions="$permissions"/>--}}

{{--                        </div>--}}
                    </createmodal>
                </div>
                <div class="col-span-1 text-center ">
                    <h1 class="text-xl font-bold">
                        Users
                    </h1>
                    <h6 class="text-sm">
                        Manage users and their roles. Click on the profiles for more information
                    </h6>
                </div>
                <div class="col-span-1">

                </div>
            </div>

                @forelse($users as $user)
                    <profilemodal :user="{{ json_encode($user, JSON_THROW_ON_ERROR) }}"
                                  :posts="{{ json_encode(count($user->posts), JSON_THROW_ON_ERROR) }}"
                                  :image="{{ json_encode($user->getAvatar(['extension' => 'webp', 'size' => 512]), JSON_THROW_ON_ERROR) }}">
                    <div class="col-span-1 border border-gray-300 rounded-xl hover:bg-indigo-300 hover:cursor-pointer"
                    title="Click to view profile">
                        <div class="flex flex-row p-1">
                            <img class="h-32 w-32 rounded-full object-cover border border-gray-200 "
                                 src="{{ $user->getAvatar(['extension' => 'webp', 'size' => 512]) }}"
                                 alt="{{ $user->getTagAttribute() }}"/>
                            <div class="w-full p-2 text-sm ">
                                <h1 class="text-center text-lg">{{ $user->global_name }}</h1>
                                <h6 class="text-center text-xs border-b border-gray-300">{{ $user->username }}</h6>
                                <h6>Roles:</h6>
                                <p>
                                    @forelse($user->getRoleNames() as $role)
                                        {{$role}},
                                    @empty
                                        No Roles
                                    @endforelse</p>
                            </div>

                        </div>
                        <div class="mx-2 flex flex-row text-xs gap-2">
                            <span>
                                ID: {{ $user->id }}
                            </span>
                            <span>
                                Joined: {{ $user->created_at->format('m/d/y') }}
                            </span>
                        </div>
                    </div>
                    </profilemodal>
                @empty
                    <div class="col-span-3 text-center font-bold">
                        No groups yet!
                    </div>
                @endforelse

        </div>
    </div>
</x-admin-layout.header>
