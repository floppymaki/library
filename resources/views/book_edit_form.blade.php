<x-app-layout>
    <form action="{{ route('book.edit', $book->ISBN) }}" method="post" class="flex justify-evenly mt-10" enctype="multipart/form-data"> 
        @csrf

        <div class="w-1/5 h-full relative">
            <!-- Old Picture, get replaced by new picture -->
            <img id="coverImage" src="{{ asset('storage/' . $book->cover_path) }}" alt="Old Cover">

            <!-- Transparent Overlay -->
            <div id="overlay" class="absolute bottom-0 left-0 w-full bg-black opacity-75 text-sky-100 text-center font-bold py-5">Upload a new cover image</div>
    
            <!-- Input for New Picture -->
            <input name="coverImage" type="file" name="new_cover" id="newCoverInput" class="absolute top-0 left-0 w-full h-full opacity-0 cursor-pointer" onchange="updateCoverImage(this)">
        </div>

            <!-- todo: Make this work -->
        @error('coverImage')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror


        <div class="flex flex-col justify-between w-1/3">
            <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 rounded">Save changes</button>
        
            <div class="py-5">
                <input autocomplete="off" name="author" id="author_name" type="text" class="text-2xl" value="{{ $book->author->name }}"></input>
                @error('author')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                
                <input name="title" type="text" class="text-4xl w-full" value="{{ $book->title }}"></input>
                Publication year: <input name="year" type="text" value="{{ $book->publication_year }}"></inpput>

                <h3 class="text-xl mt-10">Description</h3>
                <textarea name="description" type="text" class="w-full" rows="10">{{ $book->description }}</textarea>  
            </div>

            <p class="font-bold">ISBN: {{ $book->ISBN }}</p>
        </div>

    </form>



    <script>
        var authors = @json($authors);
    </script>
    <script src="{{ asset('storage/' . 'js/script.js') }}"></script>
</x-app-layout>