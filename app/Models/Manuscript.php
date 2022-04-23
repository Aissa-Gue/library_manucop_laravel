<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manuscript extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'book_part',
        'trans_day',

        'trans_day_nbr',
        'trans_month',
        'trans_syear',
        'trans_eyear',

        'trans_day_nbr_m',
        'trans_month_m',
        'trans_syear_m',
        'trans_eyear_m',

        'trans_place',
        'signed_in',

        'cabinet_id',
        'nbr_in_cabinet',
        'manu_type',
        'nbr_in_index',

        'font',
        'font_style',
        'regular_lines',
        'lines_notes',
        'nbr_of_papers',
        'paper_size',
        'size_notes',
        'save_status',
        'is_not_truncated',
        'truncation_notes',

        'transcribed_from',
        'transcribed_to',

        'manuscript_level',
        'transcriber_level',

        'rost_completion',

        'country_id',
        'city_id',
        'notes',
    ];

    public function transcribers()
    {
        return $this->belongsToMany(Transcriber::class, 'manuscript_transcribers')->withPivot('name_in_manu');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'manuscript_colors');
    }

    public function motifs()
    {
        return $this->belongsToMany(Motif::class, 'manuscript_motifs');
    }

    public function manutypes()
    {
        return $this->belongsToMany(Manutype::class, 'manuscript_manutypes');
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function cabinet()
    {
        return $this->belongsTo(Cabinet::class);
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