<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    function user() {
    	return $this->belongsTo('App\User');
    }
    
    function thread() {
    	return $this->belongsTo('App\Thread');
    }
    
    function comment() {
    	return $this->belongsTo('App\Comment');
    }
}
