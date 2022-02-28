<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManuscriptMotif extends Model
{
    use HasFactory;

    protected $fillable = [
        'manuscript_id',
        'motif_id',
    ];

    public function manuscript()
    {
        return $this->belongsTo(Manuscript::class);
    }

    public function motif()
    {
        return $this->belongsTo(Motif::class);
    }
}
