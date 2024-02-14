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

                @if($book->avgRating == 0)
                    <p>No ratings yet</p>
                @else
                    <p>Rating: {{ $book->avgRating }} out of 5</p>
                @endif

                <h3 class="text-xl mt-10">Description</h3>
                <p style="white-space: pre-line;">{{ $book->description }}</p>   
            </div>

            <p class="font-bold">ISBN: {{ $book->ISBN }}</p>
        </div>
    </div>

    <div class="grid grid-cols-3 mt-20 bg-gray-200 py-10">
        <div class="col-span-2 w-1/2 mx-auto">
            <h1 class="text-2xl">Reviews</h1>
            
            @if(Auth::check() && !Auth::user()->reviewedThisBook($book->ISBN))

                <form action="{{ route('review.place', $book->ISBN) }}" method="post" class="flex flex-col gap-y-4">
                    @csrf
                    <textarea name="comment" style="resize:none" id="" class="w-full" rows="5" placeholder="Write your review here">{{ old('comment') }}</textarea>
                    <x-input-error :messages="$errors->get('comment')" class="mt-2" />   
                    

                    <div class="flex star-rating" name="rating">
                        <svg class="star w-8 h-8 me-3 text-gray-500" data-value="1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                        </svg>
                        <svg class="star w-8 h-8 me-3 text-gray-500" data-value="2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                        </svg>
                        <svg class="star w-8 h-8 me-3 text-gray-500" data-value="3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                        </svg>
                        <svg class="star w-8 h-8 me-3 text-gray-500" data-value="4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                        </svg>
                        <svg class="star w-8 h-8 me-3 text-gray-500" data-value="5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                        </svg>
                    </div>
                    <x-input-error :messages="$errors->get('rating_value')" class="mt-2" />   

                    <input type="hidden" name="rating_value" id="rating_value">


                    
                    <button type="submit" class="px-3 bg-rose-500 hover:bg-rose-700 text-white font-bold py-2 rounded text-center">Place review</button>
                </form>
            @elseif(Auth::check())
                <p>You've already placed a review.</p>
            @else
                <p>Login to place a review.</p>
            @endif
            
            @if($book->reviews->count() == 0)
                <p>No reviews for this book have been written yet. Be the first!</p>
            @else
                @foreach($book->reviews as $review)
                    <div class="border-2 border-rose-400 bg-rose-200 mt-8 p-2">
                        <p>Rated {{ $review->rating }} out of 5</p>
                        <p class="text-lg my-2">{{ $review->comment }}</p>

                        <p class="text-gray-600 text-right">Written by {{ $review->user->name }}</p>
                    </div>
                @endforeach
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



    
    <script src="{{ asset('storage/' . 'js/rating.js') }}"></script>


</x-app-layout>