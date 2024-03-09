@php
  use App\Support\Helpers;
@endphp

<div class="h-full w-full flex-wrap">
  <nav
    class="flex h-12 w-full basis-full flex-row justify-between bg-gray-100 transition-all dark:bg-zinc-800 dark:text-gray-200"
  >
    <a
      href="{{ route("home") }}"
      class="inline-flex items-end gap-2 text-center text-gray-700 transition-all ease-in-out hover:cursor-pointer hover:text-indigo-900"
    >
      <h1
        class="pl-2 text-xl font-bold lg:pt-0 lg:text-3xl dark:text-gray-200 dark:hover:text-gray-100"
      >
        {{ config("site_settings.site_name") }}
      </h1>
      <h6 class="hidden text-sm text-blue-400 lg:block">
        {{ config("site_settings.site_slogan") }}
      </h6>
    </a>

    @auth()
      <div
        class="content-right inline-flex h-full w-fit max-w-xl items-center text-center text-gray-700 transition-all hover:cursor-pointer hover:bg-gray-50 hover:text-black lg:min-w-[208px] dark:hover:bg-zinc-600"
        x-on:click="dropdown = !dropdown"
      >
        <span
          class="{{ strlen(auth()->user()->global_name) > 15 ? "text-xs" : "" }} ml-auto overflow-hidden lg:block dark:text-gray-200"
        >
          {{ auth()->user()->global_name }}
          <span class="block text-left text-xs text-blue-400">
            {{ Helpers::get_highest_role(auth()->user())->name }}
          </span>
        </span>

        <img
          class="mx-2 mt-2 h-8 w-8 rounded-full border border-gray-200 object-cover"
          src="{{ Auth::user()->getAvatar(["extension" => "webp", "size" => 32]) }}"
          alt="{{ Auth::user()->getTagAttribute() }}"
        />
      </div>
    @else
      <div
        class=" content-right inline-flex h-full w-fit max-w-xl items-center text-center text-gray-700 hover:cursor-pointer lg:min-w-[208px]"
      >
        <a
          href="{{ route("login") }}"
          class="mr-2 inline-flex items-center h-8 cursor-pointer rounded-full border border-gray-500 bg-transparent px-1 py-1 font-semibold text-gray-700 hover:border-transparent hover:bg-indigo-900 hover:text-white dark:text-gray-200"
        >
          <x-layout.SVG.login-icon />
        </a>
      </div>
    @endauth
  </nav>
  @auth()
    <div x-show="dropdown" class="z-40" x-cloak>
      <div
        class="absolute right-0 top-12 flex w-52 flex-col border-stone-200 bg-gray-100"
      >
        <x-layout.components.dropdown-button href="{{ route('dashboard') }}">
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
      class="flex h-full flex-col justify-between bg-gray-100 shadow-2xl transition-all dark:bg-zinc-800"
      :class="{'w-12': !open, 'w-40': open}"
      x-cloak
    >
      <div class="">
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
        <x-layout.components.sidenavbutton href="{{ route('support') }}">
          <x-slot name="icon">
            <x-layout.SVG.groups-icon />
          </x-slot>
          Support
        </x-layout.components.sidenavbutton>
        <a class="transition-all hover:cursor-pointer">
          <x-layout.SVG.sidebar-icon />
        </a>
      </div>
      <x-layout.components.sidenavbutton
        href="{{ config('site_settings.discord_invite') }}"
      >
        <x-slot name="icon">
          <x-layout.SVG.discord-icon />
        </x-slot>
        Join our discord!
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
