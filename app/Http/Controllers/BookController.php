<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookBorrow;
use App\Models\BookCopy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{


    public function showCollection()
    {
        $books = Book::with('author')->paginate(8);

        // return view('collection', ['books' => $books]);
        return view('collection', compact('books'));
    }

    public function showBook($ISBN)
    {
        $book = Book::where('ISBN', $ISBN)->firstOrFail();

        // return view('book', ['book' => $book]);
        return view('book', compact('book'));
    }

    public function showEditForm($ISBN)
    {
        $authors = Author::all();
        $book = Book::where('ISBN', $ISBN)->firstOrFail();

        // return view('book_edit_form', ['book' => $book, 'authors' => $authors]);
        return view('book_edit_form', compact('book', 'authors'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $ISBN)
    {
        $book = Book::where('ISBN', $ISBN);
        $imagePath = Book::where('ISBN', $ISBN)->first()->cover_path;

            // If new image was selected, upload it and remove old picture
        if($request->coverImage) {
            $request->validate([
                'coverImage' => 'required|image|mimes:jpeg,png,gif'
            ]);


            if(!$imagePath == 'book_covers/placeholder.png') {
                Storage::disk('public')->delete($imagePath);
            }

            $imagePath = $request->file('coverImage')->store('book_covers', 'public');
        }

        $author = Author::where('name', $request->author)->first();

        if(!$author)
        {
            return Redirect::back();
            // redirect back with warning
        } 

        // check if other fields are filled



        
        $book->update([
            'title' => $request->title,
            'author_id' => $author->id,
            'publication_year' => $request->year,
            'description' => $request->description,
            'cover_path' => $imagePath,
        ]);

        return redirect('/book/' . $ISBN);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'author' => 'required',
            'title' => 'required',
            'year' => 'required',
            'description' => 'required',
            'ISBN' => 'required',
            'coverImage' => 'mimetypes:image/jpeg,image/png',
        ]);

        if($request->coverImage) {
            $imagePath = $request->file('coverImage')->store('book_covers', 'public');
        } else {
            $imagePath = 'book_covers/placeholder.png';
        }

        $author = Author::where('name', $request['author'])->first();

        if(!$author) {
            dd('this author doesnt exist');
        }

        // dd($request->all());

        Book::create([
            'ISBN' => $request['ISBN'],
            'title' => $request['title'],
            'author_id' => $author->id,
            'publication_year' => $request['year'],
            'description' => $request['description'],
            'cover_path' => $imagePath,
        ]);        

    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
