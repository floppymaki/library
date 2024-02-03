<x-app-layout>
    <div class="flex justify-evenly mt-10">
        <img src="{{ asset($book->cover_path) }}" alt="cover image" class="w-1/5">

        <div class="flex flex-col justify-between w-1/3">
            @if(Auth::check() && Auth::user()->isAdmin)
                <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 rounded">Edit book information</button>
            @endif
            <div>


                <h2 class="text-2xl">{{ $book->author->name }}</h2>
                <h1 class="text-4xl">{{ $book->title }}</h1>
                <p>Publication year: {{ $book->publication_year }}</p>

                <h3 class="text-xl mt-10">Description</h3>
                <p>{{ $book->description }}</p>   
            </div>

            <p>ISBN: {{ $book->ISBN }}</p>
        </div>
    </div>

    <div class="flex justify-around mt-20">
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
                <p>{{ $book->availableCopies->count() }} copies available right now.</p>
            @else
                <p>All copies of this book are checked out at the moment. Check again later.</p>
            @endif

            @if(Auth::check() && $book->availableCopies->count() != 0)
                <form action="{{ route('book.borrow', $book->ISBN) }}" method="post">
                    @csrf

                    <!-- <input type="submit" class="bg-rose-500 hover:bg-rose-700 text-white font-bold py-2 px-4 rounded mt-5" value="Borrow this book!"> -->
                    <button class="bg-rose-500 hover:bg-rose-700 text-white font-bold py-2 px-4 rounded mt-5">Borrow this book!</button>

                </form>
            @endif
        </div>
    </div>



    



</x-app-layout>