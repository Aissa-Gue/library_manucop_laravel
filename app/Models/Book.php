<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function authors()
    {
        return $this->belongsToMany(Book::class,'book_authors'); //via book_author table
    }
}
