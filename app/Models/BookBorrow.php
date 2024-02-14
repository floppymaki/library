<?php

namespace App\Models;

use App\Events\BookBorrowed;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookBorrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'book_copy_id', 'checked_out_at', 'checked_in_at', 'return_date',
    ];

    protected $dispatchesEvents = [
        'created' => BookBorrowed::class,
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookCopy()
    {
        return $this->belongsTo(BookCopy::class);
    }

    public function isBorrowed()
    {
        return $this->checked_in_at === null;
    }
}
