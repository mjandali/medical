<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klacht extends Model
{
    use HasFactory;

    protected $fillable = [
        'klacht'
    ];

    public function afspraak()
    {
        return $this->hasMany(Afspraak::class);
    }
}
