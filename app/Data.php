<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    //
    protected $fillable = ['alias', 'device_id', 'value', 'time'];
    protected $table = 'data';
}
