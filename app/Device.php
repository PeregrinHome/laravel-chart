<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    //
    protected $fillable = ['name', 'token', 'description', 'user_id'];
    protected $table = 'devices';
}
