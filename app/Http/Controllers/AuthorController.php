<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AuthorController extends Controller
{

    public function showAuthor($id)
    {
        $author = Author::find($id);
        $books = Book::where('author_id', $id)->get();

        // dd($id, $author);

        return view('author', compact('author', 'books'));
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
    public function create(Request $request)
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
            'bio' => 'required',
        ]);

        $author = Author::where('name', $request->author)->first();


        if($author !== null) {
            dd('this author already exists');
        }

        // create new author here
        Author::create([
            'name' => $request['author'],
            'biography' => $request['bio'],
        ]);

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $author = Author::find($id);

        $request->validate([
            'author' => 'required',
            'bio' => 'required',
        ]);


        $author->update([
            'name' => $request['author'],
            'biography' => $request['bio']
        ]);

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        //
    }
}
