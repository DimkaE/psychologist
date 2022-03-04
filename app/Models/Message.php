<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getContentFormattedAttribute()
    {
        return $this->content;
    }

    public function scopeJoinUsers($query)
    {
        return $query->leftJoin('users', 'users.id', '=', 'messages.user_id')
            ->select([
                'messages.*',
                'users.name as user_name',
                'users.last_name as user_last_name',
                'users.role as user_role',
            ]);
    }

    public function getDateFormattedAttribute()
    {
        return $this->created_at->format('d.m.Y H:i');
    }

    //scopes
    public function scopeUnread($query)
    {
        return $query->where('read', false);
    }

    public function scopeRead($query)
    {
        return $query->where('read', true);
    }
}
