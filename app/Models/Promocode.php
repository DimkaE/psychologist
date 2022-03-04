<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{
    use HasFactory;

    public const TYPE_SUM = 1;
    public const TYPE_PERCENT = 2;

    protected $fillable = [
        'code',
        'type',
        'value'
    ];
}
