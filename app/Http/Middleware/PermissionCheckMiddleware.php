<?php

namespace App\Http\Middleware;

use App\Administrator;
use App\Role;
use App\Token;
use Closure;

class PermissionCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$permissionName)
    {

        $token = $request->token;
        $administrator = Token::where('token','=',$token)->first();
        $administrator_id = $administrator->administrator_id;
        if($administrator->username=="admin"){
            return $next($request);
        }
        //通过用户id查询此用户属于哪些角色
        $roles = Administrator::find($administrator_id)->role;
        foreach($roles as $role){
            $permissions = Role::find($role->id)->permission;
            foreach($permissions as $permission){
                if($permission->permissionName==$permissionName){
                    return $next($request);
                }
            }
        }
        return response()->json([
            'status' => 'PERMISSION_DENIED',
            'content' => '你没有权限访问此方法'
        ]);


    }
}
