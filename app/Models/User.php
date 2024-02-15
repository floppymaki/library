<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Mail\BookReturnReminder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $attributes = [
        'isAdmin' => 0,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function updateIsAdmin($value)
    {
        if (Auth::user()->isAdmin()) {
            $this->update(['isAdmin' => $value]);
        }
    }

    public function borrows()
    {
        return $this->hasMany(BookBorrow::class)->whereNull('checked_in_at');
    }

    public function borrowHistory()
    {
        return $this->hasMany(BookBorrow::class)
            ->whereNotNull('checked_in_at')
            ->orderBy('checked_in_at', 'desc');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function reviewedThisBook($ISBN)
    {
        return in_array($ISBN, $this->reviews()->pluck('ISBN')->toArray());
    }

    public function isAdmin()
    {
        return $this->isAdmin == 1;
    }

    public function sendBookReturnReminder(BookBorrow $book)
    {
        // $returnDate = $book->return_date->isoFormat('MMMM D YYYY');
        Mail::to($this->email)->send(new BookReturnReminder($book));
    }
}
