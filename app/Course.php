<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    public function classes(){
        return $this->belongsToMany('App\Classes','classes_courses','course_id','class_id');
    }
}
