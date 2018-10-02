<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
	public $timestamps = false;
	
    function category() {
    	return $this->belongsTo('App\Category');
    }

    function threads() {
    	return $this->hasMany('App\Thread');
    }
    
    function comments() {
    	return $this->hasManyThrough('App\Comment', 'App\Thread');
    }
}
