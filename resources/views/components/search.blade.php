<form>
    <div class="inline-flex mt-2 h-8 lg:w-fit rounded-full">

        <input type="text" placeholder="Search"
               class="border border-stone-200 rounded-l-full pl-2 p-1 h-8 w-full lg:w-56"
               name="search" id="search" value="{{ $search }}"/>

        <button type="submit" class="h-8 w-8 rounded-r-full px-2 bg-gray-300 hover:bg-indigo-800 hover:fill-white">
            <x-layout.SVG.search-icon/>
        </button>
    </div>
</form>
