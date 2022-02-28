<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabinet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function manuscripts()
    {
        return $this->hasMany(Manuscript::class, 'cabinet_id', 'id');
    }
}
