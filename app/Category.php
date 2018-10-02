<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    function topics() {
        return $this->hasMany('App\Topic');
    }
}
