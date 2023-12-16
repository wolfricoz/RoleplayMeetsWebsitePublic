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
                           value="{{ old('title') }}"
                           required
                    />
{{--                    @error('title')--}}
                    <h1>Body</h1>
                    <summernote :name="'content'">

                    </summernote>
                    <div class="flex gap-4 my-3">

                        <div class="w-36">

                            <label for="genre" >Genre</label>
                            <select name="genre_id" id="genre" class="w-full border border-gray-300 rounded-md p-2" required>
                                @foreach($genres as $genre)
                                    <option value="{{$genre->id}}">{{$genre->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-36">
                            <label for="charage" class="">Min. Character age</label><br>
                            <input type="number" name="charage" id="charage" class="w-full border border-gray-300 rounded-md p-2"
                            value="{{ old('charage') }} required"/>
                        </div>
                        <div class="w-36">
                            <label for="partnerage">Min. Partner age</label>
                            <input type="number" name="partnerage" id="partnerage" class="w-full border border-gray-300 rounded-md p-2"
                            value="{{ old('partnerage') }}" required />
                        </div>

                    </div>

                    <button type="submit" class="mt-2 bg-indigo-900 text-white rounded-md p-2">Create</button>
                    @if($errors->any())
                        <div class="text-red-500">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li class="text-red-500 text-sm">{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </form>
            </div>
        </div>



    </div>

</x-layout.header>
