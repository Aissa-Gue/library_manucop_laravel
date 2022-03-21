<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchingFont extends Model
{
    use HasFactory;

    protected $fillable = [
        'transcriber_id',
        'transcriber_id2',
        'manuscript_id',
    ];

    public function transcriber()
    {
        return $this->belongsTo(Transcriber::class,'transcriber_id','id');
    }

    public function transcriber1()
    {
        return $this->belongsTo(Transcriber::class,'transcriber_id2','id');
    }

    public function manuscript()
    {
        return $this->belongsTo(Manuscript::class,'manuscript_id','id');
    }
}
