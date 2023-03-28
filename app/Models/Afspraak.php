<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afspraak extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'day',
        'period',
        'user_id',
        'klacht_id',
        'doctor_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function klacht()
    {
        return $this->belongsTo(Klacht::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
