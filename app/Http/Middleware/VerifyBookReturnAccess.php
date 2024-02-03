<?php

namespace App\Http\Middleware;

use App\Models\BookCopy;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class VerifyBookReturnAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $bookCopyId = $request->route('id');
        $bookCopy = BookCopy::find($bookCopyId);

        if(!$bookCopy) {
            return redirect('/');
        }
        
        $bookBorrow = $bookCopy->bookBorrow;

            // $bookBorrow will be null if its checked_in_at attribute is not null
        if($bookBorrow == null) {
            return redirect('/');
        }
            // If logged in user is not currently borrowing this book
        if(Auth::user()->id != $bookBorrow->user_id) {
            // return Redirect::route('/')->withErrors(['You are not authorized to return this book.']);
            return redirect('/');
        }

        return $next($request);
    }


}
