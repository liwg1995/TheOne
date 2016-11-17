<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\RolePermission;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RoleAndPermissionController extends Controller
{
    public function addRoleAndPermission(Request $request){
        $permissions = $request->input();
        foreach($permissions as $permission){
            if($permission['selected']==true) {
                $rolePermission = new RolePermission();
                $rolePermission->role_id = $permission['role_id'];
                $rolePermission->permission_id = $permission['id'];
                $isUsable = RolePermission::where('role_id','=',$permission['role_id'])->where('permission_id','=',$permission['id'])->first();
                if($isUsable){
                    continue;
                }else{
                    $rolePermission->save();
                }
            }else{
                RolePermission::where('role_id','=',$permission['role_id'])->where('permission_id','=',$permission['id'])->delete();


            }
        }


        return response()->json([
            'status' => 'OK',
            'content' => ""
        ]);

    }
    public function getAllRoleAndPermission(Request $request){
        $role_id = $request->input('role_id');
        $roleAndPermissions = Role::find($role_id)->permission;
        $permissions = Permission::all();
        foreach($permissions as $permission){
            $flag = false;
            $permission['role_id'] = $role_id;
            foreach($roleAndPermissions as $roleAndPermission){
                if($permission['id']==$roleAndPermission['id']){
                    $permission['selected'] = true;
                    $flag = true;
                }
            }
            if($flag==false){
                $permission['selected'] = false;
            }
        }
        return response()->json([
            'status' => 'OK',
            'content' => $permissions
        ]);
    }

}
