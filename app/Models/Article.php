<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'date',
        'name',
        'intro',
        'url',
        'meta_title',
        'meta_description',
        'text'
    ];

    protected $dates = [
        'date',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb_small')
            ->crop('crop-center', 894, 257);
        $this->addMediaConversion('thumb_big')
            ->crop('crop-center', 980, 430);
    }

    public function getThumbSmallAttribute()
    {
        $picture = $this->getMedia('image')->first();
        return $picture ? $picture->getUrl('thumb_small') : url('/images/blog1_894_257.png');
    }

    public function getThumbBigAttribute()
    {
        $picture = $this->getMedia('image')->first();
        return $picture ? $picture->getUrl('thumb_big') : url('/images/blog1_980_430.png');
    }
}
