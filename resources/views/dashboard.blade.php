<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My bookshelf') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <div>
        <p>You are borrowing {{ Auth::user()->borrows->count() }} books.</p>

        <div class="flex px-10">
            @foreach(Auth::user()->borrows as $borrowedBook)
            <div class="mx-10">
                <a href="{{ route('book', $borrowedBook->bookCopy->ISBN) }}"><img src="{{ asset($borrowedBook->bookCopy->book->cover_path) }}" class="h-64" alt="cover image"></a>
                <p>{{ $borrowedBook->bookCopy->book->title }}</p>
                <p>{{ $borrowedBook->bookCopy->book->author->name }}</p>

                <p>Checked out at: {{ $borrowedBook->checked_out_at }}</p>
                <p>Checked in at: {{ $borrowedBook->checked_in_at }}</p>
                <p>Return date: {{ $borrowedBook->return_date }}</p>

                <p>Book ID: {{ $borrowedBook->book_copy_id }}</p>

                <a href="{{ route('book.return', $borrowedBook->book_copy_id) }}">
                    @csrf
                    <button class="bg-rose-500 hover:bg-rose-700 text-white font-bold py-2 px-4 rounded mt-5">Return book</button>
                </a>

            </div>

            @endforeach
        </div>

    </div>

</x-app-layout>
