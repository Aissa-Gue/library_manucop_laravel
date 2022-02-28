<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManuscriptManutype extends Model
{
    use HasFactory;

    protected $fillable = [
        'manuscript_id',
        'manutype_id',
    ];

    public function manuscript()
    {
        return $this->belongsTo(Manuscript::class);
    }

    public function manutype()
    {
        return $this->belongsTo(Manutype::class);
    }
}
