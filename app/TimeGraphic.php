<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeGraphic extends Model
{
    //
    protected $fillable = ['name', 'alias', 'description', 'user_id', 'border_time'];
    protected $table = 'time_graphics';
}
