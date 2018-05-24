<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    //
    protected $fillable = ['name', 'token', 'description', 'user_id'];
    protected $table = 'devices';
    public function typesData()
    {
        return $this->hasMany('App\TypeData');
    }
    public function typeData($alias_type)
    {
        return $this->hasMany('App\TypeData')->where('alias', $alias_type);
    }
}
