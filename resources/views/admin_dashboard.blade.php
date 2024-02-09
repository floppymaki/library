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
    <form action="{{ route('author.add') }}" class="flex flex-col w-1/5 mx-auto hidden" method="post" id="authorForm">
        @csrf
        <input autocomplete="off" type="text" id="authorAdd" name="author" placeholder="Name" value="{{ old('author') }}">
        <textarea name="bio" id="bio" rows="10" placeholder="Description">{{ old('bio') }}</textarea>

        <button type="submit" id="submitAuthor" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 rounded">Add author</button>
    </form>


        <!-- add book form -->
    <form action="{{ route('book.add') }}" method="post" class="flex place-content-center gap-x-10" enctype="multipart/form-data" id="bookForm"> 
        @csrf

        <div class="w-1/5 h-full relative">
            <!-- Old Picture, get replaced by new picture -->
            <img id="coverImage" src="{{ asset('storage/book_covers/placeholder.png') }}" alt="Old Cover">

            <!-- Transparent Overlay -->
            <div id="overlay" class="absolute bottom-0 left-0 w-full bg-black opacity-75 text-sky-100 text-center font-bold py-5">Upload a cover image</div>
    
            <!-- Input for New Picture -->
            <input name="coverImage" type="file" name="new_cover" id="newCoverInput" class="absolute top-0 left-0 w-full h-full opacity-0 cursor-pointer" onchange="updateCoverImage(this)">
        </div>


        <div class="flex flex-col justify-between w-1/3">
       
            <div>
                <input autocomplete="off" name="author" id="author" type="text" class="text-2xl" placeholder="Author"></input>
                
                <input name="title" type="text" class="text-4xl w-full" placeholder="Title"></input>
                <input name="year" type="text"  placeholder="Publication year"></inpput>

                <h3 class="text-xl mt-10">Description</h3>
                <textarea name="description" type="text" class="w-full" rows="10"  placeholder="Description"></textarea>  

                <input type="text" name="ISBN" placeholder="ISBN">             
            </div>

            <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 mt-10 rounded">Add book</button>
        </div>
    </form>

    <script>
        const authors = {{ Js::from($authors) }};
        const addRoute = "{{ route('author.add') }}";
        const editRoute = "{{ route('author.edit') }}";
    </script>
    <script src="{{ asset('storage/' . 'js/add_authors_books.js') }}"></script>
    <script src="{{ asset('storage/' . 'js/script.js') }}"></script>
</x-app-layout>