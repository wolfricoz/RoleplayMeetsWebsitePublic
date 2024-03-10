<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config("app.name", "Laravel") }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link
      href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
      rel="stylesheet"
    />

    <!-- Summernote -->
    <script
      async
      src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4605197206330320"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
      integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
      crossorigin="anonymous"
    ></script>
    <link
      href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <style></style>
    <!-- Scripts -->
    @vite(["resources/css/app.css", "resources/js/app.js"])
  </head>
  <body
    class="h-screen w-screen font-sans antialiased dark:bg-zinc-800 overflow-hidden"
    x-data="{
      open: window.screen.width > 900,
      dropdown: false,
    }"
    x-cloak
  >
    <x-layout.nav-bar>
      {{ $slot }}
    </x-layout.nav-bar>
    @include("cookie-consent::index")
    <x-notification />
  </body>
</html>
