<?php

namespace App\Http\Controllers;

use App\Administrator;
use App\AdministratorRole;
use App\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdministratorAndRoleController extends Controller
{
    public function addAdministratorAndRole(Request $request){


        $roles = $request->input();
        foreach($roles as $role){
            if($role['selected']==true) {
                $administratorRole = new AdministratorRole();
                $administratorRole->administrator_id = $role['administrator_id'];
                $administratorRole->role_id = $role['id'];
                $isUsable = AdministratorRole::where('administrator_id','=',$role['administrator_id'])->where('role_id','=',$role['id'])->first();
                if($isUsable){
                    continue;
                }else{
                    $administratorRole->save();
                }
            }else{
                AdministratorRole::where('administrator_id','=',$role['administrator_id'])->where('role_id','=',$role['id'])->delete();


            }
        }


        return response()->json([
            'status' => 'OK',
            'content' => ""
        ]);

    }
    public function deleteAdministratorAndRole(Request $request){
        $administrator_id = $request->input('administrator_id');
        $role_id = $request->input('role_id');
        $administratorRole = AdministratorRole::where('administrator_id','=',$administrator_id)->where('role_id','=',$role_id)->delete();
        if($administratorRole){
            return response()->json([
                'status' => 'OK',
                'content' => ""
            ]);
        }else {
            return response()->json([
                'status' => 'ERROR',
                'content' => "不存在此对应关系"
            ]);
        }
    }
    public function getAllAdministratorAndRole(Request $request){
        $administrator_id = $request->input('administrator_id');
        $administratorRoles = Administrator::find($administrator_id)->role;
        $roles = Role::all();
        foreach($roles as $role){
            $flag = false;
            $role['administrator_id'] = $administrator_id;
            foreach($administratorRoles as $administratorRole){
                if($role['id']==$administratorRole['id']){
                    $role['selected'] = true;
                    $flag = true;
                }
            }
            if($flag==false){
                $role['selected'] = false;
            }
        }
        return response()->json([
            'status' => 'OK',
            'content' => $roles
        ]);
    }
}
