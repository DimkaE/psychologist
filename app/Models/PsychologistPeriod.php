<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PsychologistPeriod extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
