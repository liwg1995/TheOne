<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    //
    public function course(){
        return $this->belongsToMany('App\Course','administrator_courses','administrator_id','course_id');
    }
    public function classes(){
        return $this->belongsToMany('App\Classes','administrator_classes','administrator_id','class_id');

    }
    public function role(){
        return $this->belongsToMany('App\Role','administrator_roles','administrator_id','role_id');

    }
}
