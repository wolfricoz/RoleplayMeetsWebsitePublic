@php
    use App\Support\Helpers;
@endphp

{{-- Alright, we will be making a nav bar here, one on top and one on the side. --}}

<div class="h-full w-full flex-wrap">
    <nav
        class="flex h-12 w-full basis-full flex-row justify-between border-b border-stone-200 bg-gray-100"
    >
        <div class="inline-flex">
            <a
                href="{{ route("home") }}"
                class="h-full w-32 text-center text-gray-700 transition-all ease-in-out hover:cursor-pointer hover:text-indigo-900 lg:w-44"
            >
                <h1 class="pt-2.5 font-bold lg:pt-0 lg:text-lg">
                    Roleplay Meets
                </h1>
                <h6 class="hidden text-sm lg:block">Where roleplayers meet.</h6>
            </a>

            <a class="hover:cursor-pointer">
                <x-layout.SVG.sidebar-icon />
            </a>
        </div>
        <div
            class="content-right inline-flex h-full w-fit max-w-xl text-center text-gray-700 hover:cursor-pointer hover:bg-gray-50 hover:text-black lg:min-w-[208px]"
            x-on:click="dropdown = !dropdown"
        >
            @auth()
                <span
                    class="{{ strlen(auth()->user()->global_name) > 15 ? "pt-4 text-xs" : "py-3.5" }} ml-auto hidden overflow-hidden px-0.5 pt-1.5 lg:block"
                >
                    {{ auth()->user()->global_name }}
                    <span class="block text-left text-xs">
                        {{ Helpers::get_highest_role(auth()->user())->name }}
                    </span>
                </span>

                <img
                    class="mx-2 mt-2 h-8 w-8 rounded-full border border-gray-200 object-cover"
                    src="{{ Auth::user()->getAvatar(["extension" => "webp", "size" => 32]) }}"
                    alt="{{ Auth::user()->getTagAttribute() }}"
                />
            @else
                <a
                    href="{{ route("login") }}"
                    class="mt-2 inline-flex h-8 cursor-pointer rounded-full border border-gray-500 bg-transparent px-2 py-1 font-semibold text-gray-700 hover:border-transparent hover:bg-indigo-900 hover:text-white"
                >
                    <x-layout.SVG.login-icon />
                </a>
            @endauth
        </div>
    </nav>
    @auth()
        <div x-show="dropdown" class="" x-cloak>
            <div
                class="absolute right-0 top-12 flex w-52 flex-col border-stone-200 bg-gray-100"
            >
                <x-layout.components.dropdown-button
                    href="{{ route('dashboard') }}"
                >
                    Profile
                </x-layout.components.dropdown-button>

                <x-layout.components.dropdown-button
                    href="{{ route('users.settings') }}"
                >
                    Settings
                </x-layout.components.dropdown-button>
                @if (auth()->user()->hasPermissionTo("access_dashboard"))
                    <x-layout.components.dropdown-button
                        href="{{ route('admin.dashboard') }}"
                    >
                        Admin
                    </x-layout.components.dropdown-button>
                @endif

                <x-layout.components.dropdown-button href="">
                    <form action="{{ route("logout") }}" method="post">
                        @csrf
                        <button type="submit">logout</button>
                    </form>
                </x-layout.components.dropdown-button>
            </div>
        </div>
    @endauth

    <div class="flex h-full max-h-[95vh] w-full">
        <aside
            class="flex h-full flex-col border border-stone-200 bg-gray-100"
            :class="{'w-fit': !open, 'w-48': open}"
            x-cloak
        >
            <x-layout.components.sidenavbutton href="{{ route('home') }}">
                <x-slot name="icon">
                    <x-layout.SVG.home-icon />
                </x-slot>
                Home
            </x-layout.components.sidenavbutton>
            <x-layout.components.sidenavbutton href="{{ route('rules') }}">
                <x-slot name="icon">
                    <x-layout.SVG.rules-icon />
                </x-slot>
                rules
            </x-layout.components.sidenavbutton>
            <x-layout.components.sidenavbutton>
                <x-slot name="icon">
                    <x-layout.SVG.groups-icon />
                </x-slot>
                Groups [WIP]
            </x-layout.components.sidenavbutton>
        </aside>
        <div
            class="h-full w-full max-w-full overflow-y-scroll"
            x-on:mouseenter="dropdown = false"
        >
            {{ $slot }}
        </div>
    </div>
</div>
