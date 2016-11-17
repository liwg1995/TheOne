<?php

namespace App\Http\Controllers;

use App\AdministratorRole;
use App\Role;
use App\RolePermission;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function addRole(Request $request){
        $role = new Role();
        $role->roleName = $request->input('roleName');
        $role->save();
        return response()->json([
            'status' => 'OK',
            'content' => ""
        ]);
    }
    public function deleteRoleById(Request $request){
        $id = $request->input('id');
        $role = Role::where('id','=',$id)->delete();
        AdministratorRole::where('role_id','=',$id)->delete();
        RolePermission::where('role_id',$id)->delete();
        if($role){
            return response()->json([
                'status' => 'OK',
                'content' => ""
            ]);
        }else {
            return response()->json([
                'status' => 'ERROR',
                'content' => "不存在此id的角色"
            ]);
        }
    }
    public function modifyRoleById(Request $request){
        $role_id = $request->input('id');
        $role = Role::where('id','=',$role_id)->first();
        if($role) {
            $role->roleName = $request->input('roleName');
            $role->save();
            return response()->json([
                'status' => 'OK',
                'content' => ""
            ]);
        }else{
            return response()->json([
                'status' => 'ERROR',
                'content' => "不存在此id的角色"
            ]);
        }
    }
    public function getAllRole(Request $request){
        $roles = Role::all();
        return response()->json([
            'status' => 'OK',
            'content' => $roles
        ]);
    }
}
