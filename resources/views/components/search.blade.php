<form>
    <div class="inline-flex mt-2 h-8 lg:w-fit rounded-full">

        <input type="text" placeholder="Search"
               class="border border-stone-200 rounded-l-full pl-2 p-1 h-8 w-full lg:w-56"
               name="search" id="search" value="{{ request('search') }}"
               title="Search for a post"
        />
        <button type="submit" class="h-8 w-8 rounded-r-full px-2 bg-gray-300 hover:bg-indigo-800 hover:fill-white" title="Search for a post">
            <x-layout.SVG.search-icon/>
        </button>
        <label for="genre" class="sr-only">Genre</label>
        <select class="ml-4 border border-stone-200 rounded-full pl-2 p-1 h-8 w-full lg:w-48" id="genre" name="genre" onchange="this.form.submit()" title="Select a genre">
            <option value="">Genres</option>
            @foreach($genres as $genre)
                @if(request('genre') == $genre->id)
                    <option value="{{ $genre->id }}" selected>{{ $genre->name }}</option>
                @else
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endif
            @endforeach
        </select>
    </div>
</form>
