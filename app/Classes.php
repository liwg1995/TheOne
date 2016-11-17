<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    //
    public function course(){
        return $this->belongsToMany('App\Course','classes_courses','class_id','course_id');
    }

}
