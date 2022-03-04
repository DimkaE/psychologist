<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'meta_title',
        'meta_description'
    ];

    public function getMetaDescriptionFormattedAttribute()
    {
        return mb_strlen($this->meta_description) > 50
            ? mb_substr($this->meta_description, 0, 50) . '...'
            : $this->meta_description;
    }
}
