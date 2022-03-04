<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Review extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public const TYPE_CLIENT = 1;
    public const TYPE_PSYCHOLOGIST = 2;

    protected $fillable = [
        'name',
        'description',
        'text',
        'type',
        'sort_order'
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb1')
            ->crop('crop-center', 349, 349);
    }

    public function getThumb1Attribute()
    {
        $picture = $this->getMedia('image')->first();
        return $picture ? $picture->getUrl('thumb1') : url('/images/avatar_349.png');
    }

    public function getTextFormattedAttribute()
    {
        return mb_strlen($this->text) > 50
            ? mb_substr($this->text, 0, 50) . '...'
            : $this->text;
    }
}
