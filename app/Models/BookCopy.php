<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCopy extends Model
{
    use HasFactory;

    protected $fillable = [
        'ISBN', 'available'
    ];

    public $timestamps = false;

    public function book()
    {
        return $this->belongsTo(Book::class, 'ISBN', 'ISBN');
    }

    public function isAvailable()
    {
        return $this->available == 1;
    }

    // Each book borrow can have only one instance where id = $id and checked_in_at = null. any other instance where id = $id, checked_in_at will be filled.
    // this function should return the current borrowing information related to this book copy id
    public function bookBorrow()
    {
        return $this->hasOne(BookBorrow::class, 'book_copy_id', 'id')->whereNull('checked_in_at');
    }
}
