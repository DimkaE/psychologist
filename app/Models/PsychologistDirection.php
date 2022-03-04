<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PsychologistDirection extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'direction_id'
    ];

    protected $appends = [
        'name'
    ];

    public function getNameAttribute()
    {
        $direction = Direction::find($this->direction_id);
        return $direction ? $direction->name : '';
    }
}
