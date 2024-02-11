<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ReviewController extends Controller
{
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
        // user_id, isbn, comment, rating
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $ISBN)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
            'rating_value' => 'required|int|min:1|max:5',
        ]);


        Review::create([
            'user_id' => Auth::user()->id,
            'ISBN' => $ISBN,
            'comment' => $request->comment,
            'rating' => $request->rating_value,
        ]);

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
