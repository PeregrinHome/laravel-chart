<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Data;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function devices()
    {
        return $this->hasMany('App\Device');
    }
    public function graphics()
    {
        return $this->hasMany('App\TimeGraphic');
    }
    public function allTypes()
    {
        return $this->hasManyThrough('App\TypeData', 'App\Device');
    }
    public function device($device_id)
    {
        return $this->hasMany('App\Device')->find($device_id);
    }
    public function typesOfDevice($device_id)
    {
        return $this->hasMany('App\Device')->find($device_id)->hasMany('App\TypeData');
    }
    public function typeOfDevice($device_id, $alias_type)
    {
        return $this->hasMany('App\Device')->find($device_id)->hasMany('App\TypeData')->where('alias', $alias_type);
    }
}
