<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My bookshelf
        </h2>
    </x-slot>

    <!-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div> -->

    <div class="mx-20 py-10">
        <p class="text-2xl mb-5">You are borrowing {{ Auth::user()->borrows->count() }} books.</p>
        <div class="grid grid-cols-5 gap-y-10">
            @foreach(Auth::user()->borrows as $borrowedBook)
                <div class="me-20 border p-5 hover:bg-gradient-to-r from-cyan-500 to-blue-500 flex flex-col justify-between">
                    <a href="{{ route('book', $borrowedBook->bookCopy->ISBN) }}"><img src="{{ asset('storage/' . $borrowedBook->bookCopy->book->cover_path) }}" class="h-64" alt="cover image"></a>
                    
                    <div>
                        <p>{{ $borrowedBook->bookCopy->book->title }}</p>
                        <p>{{ $borrowedBook->bookCopy->book->author->name }}</p>

                        <p>Checked out at: {{ $borrowedBook->checked_out_at }}</p>
                        <p>Checked in at: {{ $borrowedBook->checked_in_at }}</p>
                        <p>Return date: {{ $borrowedBook->return_date }}</p>

                        <p>Book ID: {{ $borrowedBook->book_copy_id }}</p>
                    </div>


                    <a href="{{ route('book.return', $borrowedBook->book_copy_id) }}" class="text-center bg-rose-500 hover:bg-rose-700 text-white font-bold py-2 px-4 rounded mt-5">
                        Return book
                    </a>
                </div>
            @endforeach
        </div>

        <p class="text-2xl mb-5 mt-20">History</p>
        <div class="grid grid-cols-5 gap-y-10">


            @foreach(Auth::user()->borrowHistory as $book)
                <div class="me-20 border p-5 hover:bg-gradient-to-r from-cyan-500 to-blue-500 flex flex-col justify-between">
                    
                    <a href="{{ route('book', $book->bookCopy->ISBN) }}"><img src="{{ asset('storage/' . $book->bookCopy->book->cover_path) }}" class="h-64" alt="cover image"></a>
                    <p>{{ $book->bookCopy->book->title }}</p>
                    <p>{{ $book->bookCopy->book->author->name }}</p>

                    <p>Checked out at: {{ $book->checked_out_at }}</p>
                    <p>Checked in at: {{ $book->checked_in_at }}</p>
                    <p>Return date: {{ $book->return_date }}</p>

                    <p>Book ID: {{ $book->book_copy_id }}</p>
                </div>
            @endforeach
        </div>

    </div>

</x-app-layout>
