<x-layout.header>
    <div class="flex flex-row">
        <div
            id="app"
            class="m-2 mr-0 grid grid-cols-3 gap-2 lg:m-6 lg:grid-cols-4 lg:gap-4"
            x-data="{ 'layout': 'list' }"
        >
            <div
                class="col-span-3 h-fit gap-4 rounded-xl bg-gray-200 p-2 lg:col-span-3 lg:justify-center"
            >
                <h1 class="m-2 text-center text-2xl font-bold">Dashboard</h1>
                <div class="flex flex-row justify-center gap-4">
                    <div class="flex flex-row flex-wrap justify-center gap-4">
                        <article class="rounded-xl border border-gray-300 p-2">
                            <h6>Total Posts:</h6>
                            <p class="text-center">
                                {{ count($user->posts) }}
                            </p>
                        </article>
                        <article class="rounded-xl border border-gray-300 p-2">
                            <h6>Approved Posts:</h6>
                            <p class="text-center">
                                {{ count($user->posts->where("approved", "=", true)) }}
                            </p>
                        </article>
                        <article class="rounded-xl border border-gray-300 p-2">
                            <h6>Pending Posts:</h6>
                            <p class="text-center">
                                {{ count($user->posts->where("approved", "=", false)) }}
                            </p>
                        </article>
                    </div>
                </div>
            </div>
            <aside
                class="col-span-3 bg-red-500 lg:col-span-1 lg:col-start-4 lg:row-span-9"
            >
                test
            </aside>
            <x-postoptionsnav :genres="$genres"></x-postoptionsnav>

            @foreach ($posts as $post)
                <x-post :post="$post" />
            @endforeach
        </div>
    </div>
    <div class="mx-4 my-2">
        {{ $posts->links() }}
    </div>
</x-layout.header>
