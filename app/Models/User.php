<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Lang;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    public const ROLE_CUSTOMER = 1;
    public const ROLE_PSYCHOLOGIST = 2;
    public const ROLE_ADMIN = 100;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'second_name',
        'last_name',
        'birthdate',
        'experience',
        'experience_online',
        'clients',
        'psychotherapy',
        'supervision',
        'supervisor',
        'longest_consultation',
        'about',
        'other_work',
        'skype',
        'discord',
        'hangouts',
        'role',
        'gender',
        'enabled',
        'published',
        'bank_name',
        'bank_account',
        'bank_holder',
        'bank_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'psychotherapy' => 'integer',
        'supervision' => 'boolean',
        'enabled' => 'boolean',
        'published' => 'boolean',
    ];

    protected $dates = [
        'birthdate',
    ];

    protected $appends = [
        'educations',
        'educations_additional',
        'directions',
        'ava30',
        'ava52',
        'ava193',
        'periods_days',
        'periods_times',
        'experience_text',
    ];

    public function periodsRel()
    {
        return $this->hasMany(PsychologistPeriod::class);
    }

    public function educationsRel()
    {
        return $this->hasMany(PsychologistEducation::class);
    }

    public function directionsRel()
    {
        return $this->hasMany(PsychologistDirection::class);
    }

    public function paymentsRel()
    {
        return $this->hasMany(Payment::class);
    }

    public function messagesRel()
    {
        return $this->hasMany(Message::class);
    }

    public function consultationRel()
    {
        $key = $this->role == self::ROLE_PSYCHOLOGIST ? 'psychologist_id' : 'client_id';
        return $this->hasMany(Consultation::class, $key);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb30')
            ->crop('crop-center', 30, 30);
        $this->addMediaConversion('thumb52')
            ->crop('crop-center', 52, 52);
        $this->addMediaConversion('thumb115')
            ->crop('crop-center', 115, 115);
        $this->addMediaConversion('thumb193')
            ->crop('crop-center', 193, 193);
    }

    public function getAva30Attribute()
    {
        $picture = $this->getMedia('avatar')->first();
        return $picture ? $picture->getUrl('thumb30') : url('/images/avatar_30.png');
    }

    public function getAva52Attribute()
    {
        $picture = $this->getMedia('avatar')->first();
        return $picture ? $picture->getUrl('thumb52') : url('/images/avatar_52.png');
    }

    public function getAva115Attribute()
    {
        $picture = $this->getMedia('avatar')->first();
        return $picture ? $picture->getUrl('thumb115') : url('/images/avatar_115.png');
    }

    public function getAva193Attribute()
    {
        $picture = $this->getMedia('avatar')->first();
        return $picture ? $picture->getUrl('thumb193') : url('/images/avatar.png');
    }

    public function getDiplomasAttribute()
    {
        return $this->getMedia('diplomas');
    }

    public function getBirthdateFormattedAttribute()
    {
        return $this->birthdate ? $this->birthdate->format('d.m.Y') : '';
    }

    public function getEducationsAttribute()
    {
        return $this->educationsRel()->where('primary', true)->pluck('education');
    }

    public function getEducationsAdditionalAttribute()
    {
        return $this->educationsRel()->where('primary', false)->pluck('education');
    }

    public function getDirectionsAttribute()
    {
        return $this->directionsRel()->pluck('direction_id');
    }

    public function getPeriodsDaysAttribute()
    {
        return $this->periodsRel()->where('type', 'day')->pluck('number')->toArray();
    }

    public function getPeriodsTimesAttribute()
    {
        return $this->periodsRel()->where('type', 'time')->pluck('number')->toArray();
    }

    public function getNameEmailAttribute()
    {
        return "$this->last_name $this->name ($this->email)";
    }

    public function getExperienceTextAttribute()
    {
        return Lang::choice('год|года|лет', $this->experience);
    }

    //scopes
    public function scopePsychologist($query)
    {
        return $query->where('role', '=', self::ROLE_PSYCHOLOGIST);
    }

    public function scopeVisible($query)
    {
        return $query->where([
            ['enabled', '=', true],
            ['published', '=', true],
        ]);
    }
}
