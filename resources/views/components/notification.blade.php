<div
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => (show = false), 10000)"
    class=""
    x-transition.duration.1000ms
>
    @if (session()->has("success"))
        <div class="fixed bottom-0 right-0 m-5 rounded-xl bg-green-300 p-2">
            {{ session()->get("success") }}
        </div>
    @endif()

    @if (session()->has("error"))
        <div class="fixed bottom-0 right-0 m-5 rounded-xl bg-red-500 p-2">
            {{ session()->get("error") }}
        </div>
    @endif()
</div>
