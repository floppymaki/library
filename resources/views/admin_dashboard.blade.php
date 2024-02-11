<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Panel') }}
        </h2>
    </x-slot>



    <div class="my-10 flex justify-center gap-x-10">
        <button class="bg-indigo-500 hover:bg-indigo-500 text-white font-bold py-2 rounded w-1/6" onclick="toggleForm(this)" id="showBook">Book form</button>
        <button class="bg-indigo-300 hover:bg-indigo-500 text-white font-bold py-2 rounded w-1/6" onclick="toggleForm(this)" id="showAuthor">Author form</button>
    </div>



        <!-- add author form -->
    <div id="authorDiv" class="hidden justify-evenly ">
        <div class="border-4">
            <p class="text-xl px-4 py-2">Author list</p>

            @foreach($authors as $author)
                <p class="px-4 py-1 hover:cursor-pointer hover:bg-gray-300"  onclick="fillForm({{ Js::from($author) }})">{{ $author->name }}</p>
            @endforeach
        </div>

        <form id="authorForm" action="{{ route('author.add') }}" method="post" class="flex flex-col w-1/5">
            @csrf
            <input autocomplete="off" type="text" id="add_author_name" name="author" placeholder="Name" value="{{ old('author') }}">
            <textarea name="bio" id="bio" rows="10" placeholder="Description">{{ old('bio') }}</textarea>

            <button type="submit" id="submitAuthor" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 rounded">Add author</button>
        </form>
    </div>
    


        <!-- add book form -->
    <form action="{{ route('book.add') }}" method="post" class="flex place-content-center gap-x-10" enctype="multipart/form-data" id="bookForm"> 
        @csrf

        <div class="w-1/5 h-full relative">
            <x-input-error :messages="$errors->get('coverImage')" class="mt-2" />
            
            <!-- Old Picture, get replaced by new picture -->
            <img id="coverImage" src="{{ asset('storage/book_covers/placeholder.png') }}" alt="Old Cover">

            <!-- Transparent Overlay -->
            <div id="overlay" class="absolute bottom-0 left-0 w-full bg-black opacity-75 text-sky-100 text-center font-bold py-5">Upload a cover image</div>
    
            <!-- Input for New Picture -->
            <input name="coverImage" type="file" name="new_cover" id="newCoverInput" class="absolute top-0 left-0 w-full h-full opacity-0 cursor-pointer" onchange="updateCoverImage(this)">
        

        </div>



        <div class="flex flex-col justify-between w-1/3">
       
            <div>
                <input autocomplete="off" name="author" id="author_name" type="text" class="text-2xl" placeholder="Author" value="{{ old('author') }}"></input>
                <x-input-error :messages="$errors->get('author')" class="mt-2" />

                <input name="title" type="text" class="text-4xl w-full" placeholder="Title" value="{{ old('title') }}"></input>
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                
                <input name="year" type="text"  placeholder="Publication year" value="{{ old('year') }}"></inpput>
                <x-input-error :messages="$errors->get('year')" class="mt-2" />

                <h3 class="text-xl mt-10">Description</h3>
                <textarea name="description" type="text" class="w-full" rows="10"  placeholder="Description">{{ old('description') }}</textarea>  
                <x-input-error :messages="$errors->get('description')" class="mt-2" />

                <input type="text" name="ISBN" placeholder="ISBN" value="{{ old('ISBN') }}">
                <x-input-error :messages="$errors->get('ISBN')" class="mt-2" />           
            </div>

            <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 mt-10 rounded">Add book</button>
        </div>
    </form>

    <script>
        const authors = {{ Js::from($authors) }};
        const addRoute = "{{ route('author.add') }}";
        const editRoute = "{{ route('author.edit', '') }}";
    </script>
    <script src="{{ asset('storage/' . 'js/add_authors_books.js') }}"></script>
    <script src="{{ asset('storage/' . 'js/script.js') }}"></script>
</x-app-layout>