<x-app-layout>
    <div class="flex justify-evenly mt-10">
        <img src="{{ asset('storage/' . $book->cover_path) }}" alt="cover image" class="w-1/5 h-full">

        <div class="flex flex-col justify-between w-1/3">
            @if(Auth::check() && Auth::user()->isAdmin)
            <div class="grid grid-cols-2 gap-x-10">
                <a href="{{ route('book.editForm', $book->ISBN) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 rounded text-center">Edit book information</a>
                <a href="{{ route('book.addCopy', $book->ISBN) }}" class="bg-rose-500 hover:bg-rose-700 text-white font-bold py-2 rounded text-center">Add new copy</a>
            </div>
                
            @endif
            <div>


                <a href="{{ route('author.show', $book->author->id) }}" class="text-2xl text-gray-600">{{ $book->author->name }}</a>
                <p class="text-4xl">{{ $book->title }}</p>
                <p>Publication year: {{ $book->publication_year }}</p>

                <h3 class="text-xl mt-10">Description</h3>
                <p style="white-space: pre-line;">{{ $book->description }}</p>   
            </div>

            <p class="font-bold">ISBN: {{ $book->ISBN }}</p>
        </div>
    </div>

    <div class="flex justify-around mt-20 bg-gray-200 py-10">
        <div>
            <h1 class="text-2xl">Reviews</h1>
            
            @if($book->reviews->count() == 0)
                <p>No reviews for this book have been written yet. Be the first!</p>
            @else
                <p>very good book</p>
            @endif
        </div>

        <div>
            <h3 class="text-2xl">Availability</h3>

            @if($book->availableCopies->count() != 0)
                <p>This book is available to borrow.</p>
                <p>{{ $book->availableCopies->count() }} {{ $book->availableCopies->count() == 1 ? 'copy' : 'copies' }} available right now.</p>
            @else
                <p>All copies of this book are checked out at the moment. Check again later.</p>
            @endif

            @if(Auth::check() && $book->availableCopies->count() != 0)
                <a href="{{ route('book.borrow', $book->ISBN) }}">
                    <!-- <input type="submit" class="bg-rose-500 hover:bg-rose-700 text-white font-bold py-2 px-4 rounded mt-5" value="Borrow this book!"> -->
                    <button class="bg-rose-500 hover:bg-rose-700 text-white font-bold py-2 px-4 rounded mt-5">Borrow this book!</button>
                </a>
            @endif

            @if(!Auth::check())
                <button class="bg-gray-400 text-white font-bold py-2 px-4 rounded mt-5" disabled>Login to borrow this book</button>
            @endif
        </div>
    </div>



    



</x-app-layout>