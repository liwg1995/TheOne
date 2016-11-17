<?php

namespace App\Http\Controllers;

use App\Administrator;
use App\AdministratorCourse;
use App\AdministratorRole;
use App\ClassesCourse;
use App\Course;
use App\MajorAdministrator;
use App\Token;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdministratorController extends Controller
{
    public function addAdministrator(Request $request){
        $username = $request->input('username');
        $isValid = Administrator::where('username','=',$username)->first();
        if(!$isValid){
            $administrator = new Administrator();
            $administrator->username = $username;
            $administrator->password = $request->input('password');
            $administrator->nickname = $request->input('nickname');
            $administrator->isValid = true;
            $administrator->save();
            return response()->json([
                'status' => 'OK',
                'content' => ""
            ]);
        }else {
            return response()->json([
                'status' => 'ERROR',
                'content' => "此用户名已经存在"
            ]);
        }

    }
    public function deleteAdministratorById(Request $request){
        $administrator_id = $request->input('administrator_id');
        $isDelete = AdministratorCourse::where('administrator_id','=',$administrator_id)->first();
        if(!$isDelete){
            Administrator::where('id','=',$administrator_id)->delete();
            AdministratorRole::where('administrator_id','=',$administrator_id)->delete();
            MajorAdministrator::where('administrator_id','=',$administrator_id)->delete();
            Token::where('administrator_id','=',$administrator_id)->delete();
            return response()->json([
                'status' => 'OK',
                'content' => ""
            ]);
        }else {
            return response()->json([
                'status' => 'ERROR',
                'content' => "此用户下有对应的课程不能删除"
            ]);
        }
    }

    public function getAllAdministrator(Request $request){
        $administrators = Administrator::all();
        return response()->json([
            'status' => 'OK',
            'content' => $administrators
        ]);
    }
}
