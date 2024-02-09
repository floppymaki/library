<x-app-layout>

<div class="flex flex-col items-center w-1/2 mx-auto">
    <p class="text-3xl text-center py-10">{{ $author->name }}</p>

    @foreach ($books as $book)
        <div class="flex mb-8 border">
            <a href="{{ route('book', $book->ISBN) }}">
                <img class="h-64 min-w-48 object-cover" src="{{ asset('storage/' . $book->cover_path) }}" alt="cover image">
            </a>

            <div class="m-4">
                <p>{{ $book->author->name }}</p>
                <a href="{{ route('book', $book->ISBN) }}" class="font-bold text-xl text-gray-600">{{ $book->title }}</a>
                <p>{{ $book->description }}</p>
            </div>
        </div>
    @endforeach
</div>




</x-app-layout>