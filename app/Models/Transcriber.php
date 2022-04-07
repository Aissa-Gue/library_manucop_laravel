<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transcriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'descent1',
        'descent2',
        'descent3',
        'descent4',
        'descent5',
        'last_name',
        'nickname',
        'other_name1',
        'other_name2',
        'other_name3',
        'other_name4',
        'country_id',
        'city_id',
    ];

    public function manuscripts()
    {
        return $this->belongsToMany(Manuscript::class, 'manuscript_transcribers');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}