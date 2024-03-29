<x-app-layout>

    <div class="relative isolate overflow-hidden px-6 py-8 sm:py-12 lg:overflow-visible lg:px-0">
  <div class="absolute inset-0 -z-10 overflow-hidden">
    <svg class="absolute left-[max(50%,25rem)] top-0 h-[64rem] w-[128rem] -translate-x-1/2 stroke-gray-200 [mask-image:radial-gradient(64rem_64rem_at_top,white,transparent)]" aria-hidden="true">
      <defs>
        <pattern id="e813992c-7d03-4cc4-a2bd-151760b470a0" width="200" height="200" x="50%" y="-1" patternUnits="userSpaceOnUse">
          <path d="M100 200V.5M.5 .5H200" fill="none" />
        </pattern>
      </defs>
      <svg x="50%" y="-1" class="overflow-visible fill-gray-50">
        <path d="M-100.5 0h201v201h-201Z M699.5 0h201v201h-201Z M499.5 400h201v201h-201Z M-300.5 600h201v201h-201Z" stroke-width="0" />
      </svg>
      <rect width="100%" height="100%" stroke-width="0" fill="url(#e813992c-7d03-4cc4-a2bd-151760b470a0)" />
    </svg>
  </div>

  <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-4 lg:items-start lg:gap-y-10">

    @foreach ($books as $book)
      <div class="mx-auto w-4/5 border-solid border-2 border-sky-500 rounded-md py-5 px-3 h-80 bg-indigo-100 flex flex-col justify-between">
        <div>
          <h3 class="text-xl font-bold">{{ $book->title }}</h3>
          <p>Author: {{ $book->author->name }}</p>
          <p>Publication Year: {{ $book->publication_year }}</p>
          <p class="mb-4">ISBN: {{$book->ISBN}}</p>
        </div>

        <div>
          <a href="{{ route('book', $book->ISBN) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-5">View book</a>
        </div>
      </div>
    @endforeach
  </div>




  <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-center mt-5">
    <p>Showing {{ $books->firstItem() }} to {{ $books->lastItem() }} of {{ $books->total() }} results</p>

    <div class="flex items-center ms-5">
      @if($books->hasPages())
        @if(!$books->onFirstPage())
          <a href="{{ $books->previousPageUrl() }}" class="me-2">Previous</a>
        @endif

        <!-- add page buttons here -->
        @for ($i = 1; $i <= $books->lastPage(); $i++)
          @if($books->currentPage() === $i)
            <a href="{{ $books->url($i) }}" class="relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ $i }}</a>
          @else
            <a href="{{ $books->url($i) }}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">{{ $i }}</a>
          @endif
        @endfor


        @if($books->currentPage() !== $books->lastPage())
          <a href="{{ $books->nextPageUrl() }}" class="ms-2">Next</a>
        @endif
      @endif
    </div>

  </div>
  
  


</x-app-layout>