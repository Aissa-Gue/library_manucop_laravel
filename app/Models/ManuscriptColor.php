<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManuscriptColor extends Model
{
    use HasFactory;

    protected $fillable = [
        'manuscript_id',
        'color_id',
    ];

    public function manuscript()
    {
        return $this->belongsTo(Manuscript::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
