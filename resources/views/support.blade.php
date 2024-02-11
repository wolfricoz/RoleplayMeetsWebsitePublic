<x-layout.header>
  <div id="app" class="m-6 grid grid-cols-1 gap-4" x-data="">
    <div
      class="col-span-1 rounded-xl bg-gray-100 p-6 "
    >
      <h1 class="text-center text-xl font-bold">Support information</h1>
      <p>
        If you have any questions or run into any issues, please contact us at <a href="mailto:{{ config("site_settings.support_email") }}" class="text-indigo-700">{{ config("site_settings.support_email") }}</a> or join our <a href="{{ config("site_settings.discord_invite") }}" class="text-indigo-700">Discord server</a>.
      </p>
    </div>

  </div>
</x-layout.header>
