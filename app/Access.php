<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    protected $fillable = ['access', 'name', 'description'];
    protected $table = 'accesses';
    protected $guarded = [];
}
