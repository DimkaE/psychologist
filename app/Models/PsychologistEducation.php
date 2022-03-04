<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PsychologistEducation extends Model
{
    use HasFactory;

    protected $table = 'psychologist_educations';

    protected $fillable = [
        'user_id',
        'education',
        'primary'
    ];

    protected $casts = [
        'primary' => 'boolean'
    ];

}
