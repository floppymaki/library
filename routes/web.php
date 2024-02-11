<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookCopyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
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

    Route::get('/edit/{ISBN}', 'showEditForm')->middleware(['auth', 'verified', 'admin'])->name('book.editForm');
    Route::post('/edit/{ISBN}', 'edit')->middleware(['auth', 'verified', 'admin'])->name('book.edit');
    Route::post('/book/add', 'store')->middleware(['auth', 'verified', 'admin'])->name('book.add');

});

Route::controller(AuthorController::class)->group(function () {
    Route::get('/author/{id}', 'showAuthor')->name('author.show');
    Route::post('/addAuthor', 'store')->name('author.add')->middleware(['auth', 'verified', 'admin']);
    Route::post('/editAuthor/{id}', 'update')->name('author.edit')->middleware(['auth', 'verified', 'admin']);
});

Route::controller(ReviewController::class)->group(function () {
    Route::post('/placeReview/{ISBN}', 'store')->name('review.place')->middleware(['auth', 'verified']);
});

Route::controller(BookCopyController::class)->group(function () {
    Route::get('/borrow/{ISBN}', 'borrow')->middleware(['auth', 'verified'])->name('book.borrow');
    Route::get('/return/{id}', 'return')->middleware(['auth', 'verified', 'verifyBookReturnAccess'])->name('book.return');
    Route::get('/addCopy/{ISBN}', 'create')->middleware(['auth', 'verified', 'admin'])->name('book.addCopy');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(AdminController::class)->group(function () {
    Route::get('/admin', 'showDashboard')->middleware(['auth', 'verified', 'admin'])->name('admin.main');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
