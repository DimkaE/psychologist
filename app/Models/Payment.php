<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public const STATUS_NEW = 1;
    public const STATUS_PAYED = 2;

    public const PAY_SYSTEM_TEST = 1;
    public const PAY_SYSTEM_STRIPE = 2;
    public const PAY_SYSTEM_ADMIN = 100;

    public const PAY_STATUS_NEW = 1;
    public const PAY_STATUS_PAYED = 2;

    protected $fillable = [
        'consultation_id',
        'user_id',
        'status',
        'sum',
        'final_sum',
        'system',
        'comment',
        'pay_status',
        'pay_out_sum'
    ];

    protected $dates = [
        'pay_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function getPayDateFormattedAttribute()
    {
        return $this->pay_date ? $this->pay_date->format('d.m.Y H:i') : '';
    }
}
