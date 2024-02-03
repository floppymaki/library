<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookCopyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('home');

Route::controller(BookController::class)->group(function () {
    Route::get('/collection', 'showCollection')->name('collection');
    Route::get('/book/{ISBN}', 'showBook')->name('book');

    Route::post('/edit/{ISBN}', 'edit')->middleware(['auth', 'verified', 'admin'])->name('book.edit');
});

Route::controller(BookCopyController::class)->group(function () {
    Route::post('/borrow/{ISBN}', 'borrow')->middleware(['auth', 'verified'])->name('book.borrow');
    Route::get('/return/{id}', 'return')->middleware(['auth', 'verified', 'verifyBookReturnAccess'])->name('book.return');
});

Route::get('/admin', function () {
    return view('admin_dashboard');
})->middleware(['auth', 'verified', 'admin'])->name('admin.main');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
