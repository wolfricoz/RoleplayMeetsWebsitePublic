<x-layout.header>
    <div id="app" class="m-4 flex justify-center">
        <div class="w-2/3 h-fit bg-gray-100 p-4">
            <div>
                <h1 class="text-2xl text-center">Create Post</h1>
                <form method="post" action="">
                    @csrf
                    @method('put')
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="w-full border border-gray-300 rounded-md p-2"
                           value="{{ old('title') }}"/>
{{--                    @error('title')--}}
                    <h1>Body</h1>
                    <summernote :name="'body'">

                    </summernote>
                    <button type="submit" class="bg-indigo-900 text-white rounded-md p-2">Create</button>
                </form>
            </div>
        </div>



    </div>

</x-layout.header>
