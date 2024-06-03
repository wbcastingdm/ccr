<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'phone',
        'balance',
        'level_id',
        'type_id'
    ];

    /**
     * Relations
     */

    public function pointsHistory()
    {
        return $this->hasMany(Point::class, 'user_id');
    }

    public function level()
    {
        return $this->belongsTo(Point::class);
    }
}
