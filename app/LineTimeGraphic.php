<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LineTimeGraphic extends Model
{
    //
    protected $fillable = ['name', 'data_alias', 'description', 'color', 'graphics_id'];
    protected $table = 'line_time_graphics';
}
