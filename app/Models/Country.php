<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function manuscripts()
    {
        return $this->hasMany(Manuscript::class, 'country_id', 'id');
    }

    public function transcribers()
    {
        return $this->hasMany(Transcriber::class, 'country_id', 'id');
    }

    public function cities()
    {
        return $this->hasMany(City::class, 'country_id', 'id');
    }
}