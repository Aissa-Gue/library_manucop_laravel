<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function manuscripts()
    {
        return $this->hasMany(Manuscript::class, 'city_id', 'id');
    }

    public function transcribers()
    {
        return $this->hasMany(Transcriber::class, 'city_id', 'id');
    }
}
