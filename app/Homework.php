<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    //
    public function student(){
        return $this->belongsToMany('App\Student','student_homeworks','homework_id','student_id');
    }
}
