<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'first_name', 'last_name', 'email', 'username', 'password', 'role_id','image',
    ];
    
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    function threads() {
        return $this->hasMany('App\Thread', 'user_id');
    }

    
    function comments() {
        return $this->hasMany('App\Comment');
    }

    function likes() {
        return $this->belongsToMany('App\Thread', 'likes', 'user_id', 'thread_id');
    }

    function reports() {
        return $this->hasMany('App\Report');
    }
    
    function role() {
        return $this->belongsTo('App\Role');
    }


}
