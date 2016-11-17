<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    public function permission(){
        return $this->belongsToMany('App\Permission','role_permissions','role_id','permission_id');

    }
}
