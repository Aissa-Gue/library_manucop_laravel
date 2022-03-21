<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function manuscripts()
    {
        return $this->belongsToMany(Manuscript::class,'manuscript_colors'); //via manuscript_colors table
    }
}