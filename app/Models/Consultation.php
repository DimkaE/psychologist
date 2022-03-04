<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    public const STATUS_NEW = 1;
    public const STATUS_PAYED = 2;
    public const STATUS_CANCELLED_BY_CLIENT = 10;
    public const STATUS_CANCELLED_BY_PSYCHOLOGIST = 20;

    protected $fillable = [
        'status',
        'datetime',
        'psychologist_id',
        'client_id'
    ];

    protected $appends = [
        'date',
        'time',
        'mutable',
        'line1',
        'line2',
    ];

    protected $dates = [
        'datetime'
    ];

    //relations
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function psychologist()
    {
        return $this->belongsTo(User::class, 'psychologist_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    //accessors
    public function getDateAttribute()
    {
        return $this->datetime->format('d.m.Y');
    }

    public function getTimeAttribute()
    {
        return $this->datetime->format('H:i');
    }

    public function getMutableAttribute()
    {
        return $this->datetime > new Carbon('+12hours')
            && (in_array($this->status, [self::STATUS_NEW, self::STATUS_PAYED]));
    }

    public function getLine1Attribute()
    {
        $return = '';
        foreach (PsychologistDirection::where('user_id', $this->psychologist_id)->get() as $item) {
            if ($return)
                $return .= ', ';
            $return .= $item->name;
        }
        return $return;

    }

    public function getLine2Attribute()
    {
        return Consultation::where([
            ['psychologist_id', $this->psychologist_id],
            ['client_id', $this->client_id],

        ])
            ->whereIn('status', [self::STATUS_NEW, self::STATUS_PAYED])
            ->count() > 1 ? 'Повторный прием' : 'Первичный прием';
    }

    //scopes
    public function scopeActive($query)
    {
        return $query->whereIn('status', [Consultation::STATUS_NEW, Consultation::STATUS_PAYED]);
    }
}
