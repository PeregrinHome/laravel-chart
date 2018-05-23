<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeData extends Model
{
    //
    protected $fillable = ['device_id', 'alias', 'description', 'name'];
    protected $table = 'data_aliases';
}
