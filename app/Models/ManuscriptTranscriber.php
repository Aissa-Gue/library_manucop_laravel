<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManuscriptTranscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'manuscript_id',
        'transcriber_id',
        'name_in_manu',
    ];
}
