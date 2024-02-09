<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function showDashboard()
    {
        $authors = Author::all()->sortBy('name')->values()->all();
        
        return view('admin_dashboard', compact('authors'));
    }
}
