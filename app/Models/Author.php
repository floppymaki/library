<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'biography'];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
