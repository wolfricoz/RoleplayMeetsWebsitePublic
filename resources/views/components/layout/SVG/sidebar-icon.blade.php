{{-- Hide Icon --}}
<div class="items-center my-1 inline-flex w-full border-gray-200 fill-stone-600 text-gray-700 transition-all ease-in-out hover:cursor-pointer hover:border-r hover:bg-gray-50 hover:fill-indigo-900 hover:text-black dark:border-blue-600 dark:bg-zinc-800 dark:fill-blue-400 dark:text-gray-200 dark:hover:bg-zinc-600 dark:hover:fill-blue-600 dark:hover:text-blue-400"
x-on:click="open = !open"
title="You can open or close the sidebar with this button."
>
  <svg
    xmlns="http://www.w3.org/2000/svg"
    width="48px"
    height="48px"
    viewBox="0 0 48 48"
    class="m-2 h-8 w-8 fill-stone-700 hover:fill-indigo-900 dark:fill-blue-400 dark:hover:fill-blue-600"

    x-show="open"
    x-cloak

  >
    <g id="surface1">
      <path
        d="M -2.507812 -2.296875 L -2.507812 50.695312 L 50.484375 50.695312 L 50.484375 -2.296875 Z M 2.460938 2.671875 L 10.738281 2.671875 L 10.738281 45.730469 L 2.460938 45.730469 Z M 15.707031 45.730469 L 15.707031 2.671875 L 45.515625 2.671875 L 45.515625 45.730469 Z M 15.707031 45.730469 "
      />
      <path
        d="M 29.152344 24.175781 L 37.34375 32.367188 L 33.832031 35.878906 L 22.125 24.175781 L 33.828125 12.472656 L 37.34375 15.984375 Z M 29.152344 24.175781 "
      />
    </g>
  </svg>
  <svg
  xmlns="http://www.w3.org/2000/svg"
  width="48px"
  height="48px"
  viewBox="0 0 48 48"
  class="m-2 h-8 w-8 fill-stone-700 hover:fill-indigo-900 dark:fill-blue-400 dark:hover:fill-blue-600"

  x-show="!open"
  x-cloak

>
  <g id="surface1">
    <path
      d="M -2.507812 -2.296875 L -2.507812 50.695312 L 50.484375 50.695312 L 50.484375 -2.296875 Z M 2.460938 2.671875 L 10.738281 2.671875 L 10.738281 45.730469 L 2.460938 45.730469 Z M 15.707031 45.730469 L 15.707031 2.671875 L 45.515625 2.671875 L 45.515625 45.730469 Z M 15.707031 45.730469 "
    />
    <path
      d="M 30.300781 24.203125 L 22.105469 16.007812 L 25.621094 12.496094 L 37.324219 24.203125 L 25.621094 35.90625 L 22.109375 32.390625 Z M 30.300781 24.203125 "
    />
  </g>
  <span class="font-bold" x-text="open ? 'Hide' : 'Show'" x-show="open" >

  </span>


</svg>

</div>




{{-- Show Icon --}}

