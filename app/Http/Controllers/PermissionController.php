<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function addPermission(Request $request){
        $permission = new Permission();
        $permission->permissionName = $request->input('permissionName');
        $permission->save();
        return response()->json([
            'status' => 'OK',
            'content' => ""
        ]);
    }
    public function deletePermissionById(Request $request){
        $id = $request->input('id');
        $permission = Permission::where('id','=',$id)->delete();
        if($permission){
            return response()->json([
                'status' => 'OK',
                'content' => ""
            ]);
        }else {
            return response()->json([
                'status' => 'ERROR',
                'content' => "不存在此id的学院"
            ]);
        }
    }
    public function getAllPermission(Request $request){
        $permissions = Permission::all();
        return response()->json([
            'status' => 'OK',
            'content' => $permissions
        ]);
    }
}
