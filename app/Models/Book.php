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
        return $this->belongsToMany(Author::class,'book_authors'); //via book_authors table
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class,'book_subjects'); //via book_subjects table
    }

    public function manuscripts()
    {
        return $this->belongsTo(manuscript::class);
    }
}
