<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tickets(){
        return $this->hasMany(Tickets::class)->latest();
        //latest() выведет последний созданный тикет в начало
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function getAvatarAttribute()
    {
        return "https://i.pravatar.cc/150?u=" . $this->email;
    }

    public function path($append='')
    {   $path = route('profile', $this->name);
        return $append ? "{$path}/{$append}": $path;
    }

}
