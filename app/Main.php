<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Main extends Model
{
    protected $fillable = ['id', 'number'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
