<div class="js-cookie-consent cookie-consent fixed inset-x-0 bottom-0 pb-2 z-50">
  <div class="mx-auto max-w-7xl px-6">
    <div class="rounded-lg bg-yellow-100 p-2">
      <div class="lg:flex lg:flex-wrap items-center lg:justify-between ">
        <div class="flex-1 items-center  md:inline w-full ">
          <p class="cookie-consent__message w-full md:ml-3 text-sm md:text-base text-black">
            {!! trans("cookie-consent::texts.message") !!}
          </p>
        </div>
        <div class="mt-2 w-full flex-shrink-0 sm:mt-0 sm:w-auto">
          <button
            class="js-cookie-consent-agree cookie-consent__agree flex cursor-pointer items-center justify-center rounded-md bg-yellow-400 px-4 py-2 text-sm font-medium text-yellow-800 hover:bg-yellow-300"
          >
            {{ trans("cookie-consent::texts.agree") }}
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
