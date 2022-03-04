<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Question extends Model
{
    use HasFactory;

    public const TYPE_CLIENT = 1;
    public const TYPE_PSYCHOLOGIST = 2;

    protected $fillable = [
        'question',
        'answer',
        'type'
    ];

    public function getAnswerFormattedAttribute()
    {
        return mb_strlen($this->answer) > 50
            ? mb_substr($this->answer, 0, 50) . '...'
            : $this->answer;
    }
}
