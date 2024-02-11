<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'ISBN', 'title', 'author_id', 'publication_year', 'description', 'cover_path',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function copies()
    {
        return $this->hasMany(BookCopy::class, 'ISBN', 'ISBN');
    }

    public function availableCopies()
    {
        return $this->copies()->where('available', 1);
    }

    public function unavailableCopies()
    {
        return $this->copies()->where('available', 0);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'ISBN', 'ISBN')->orderBy('created_at', 'desc');
    }

    protected function avgRating(): Attribute
    {
        return Attribute::make(get: function () {
            $ratings = $this->reviews()->pluck('rating')->toArray();
            $averageRating = count($ratings) > 0 ? array_sum($ratings) / count($ratings) : 0;
            return $averageRating;
        });
    }
}
