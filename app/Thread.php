<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    function user() {
    	return $this->belongsTo('App\User');
    }

     function comments() {
    	return $this->hasMany('App\Comment');
    }

    function topic() {
    	return $this->belongsTo('App\Topic');
    }

     function likes() {
    	return $this->belongsToMany('App\User','likes')
    		->withTimestamps();
    }
    
    function reports() {
        return $this->hasMany('App\Report');
    }
}
