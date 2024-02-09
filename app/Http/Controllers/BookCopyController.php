<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookBorrow;
use App\Models\BookCopy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class BookCopyController extends Controller
{

    public function borrow($ISBN) {
        $bookCopy = BookCopy::where('ISBN', $ISBN)->where('available', 1)->firstOrFail();

        $checkOutDate = Carbon::now()->format('Y-m-d');
        $returnDate = Carbon::now()->addMonth()->format('Y-m-d');

        $bookBorrow = BookBorrow::create([
            'user_id' => Auth::user()->id,
            'book_copy_id' => $bookCopy->id, 
            'checked_out_at' => $checkOutDate,  
            'return_date' => $returnDate,
        ]);

        $bookCopy->update([
            'available' => 0,
        ]);

        return Redirect::back();
    }

    public function return($id) {
        $bookCopy = BookCopy::find($id);
        $bookBorrow = $bookCopy->bookBorrow;
        $today = Carbon::now()->format('Y-m-d');

        $bookBorrow->update([
            'checked_in_at' => $today,
        ]);

        $bookCopy->update([
            'available' => 1,
        ]);

        return Redirect::back();
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
    public function create($ISBN)
    {
        Book::where('ISBN', $ISBN)->firstOrFail();

        BookCopy::create([
            'ISBN' => $ISBN,
            'available' => 1,
        ]);

        return Redirect::back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BookCopy $bookCopy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookCopy $bookCopy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookCopy $bookCopy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookCopy $bookCopy)
    {
        //
    }
}
