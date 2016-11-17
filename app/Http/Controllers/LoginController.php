<?php

namespace App\Http\Controllers;

use App\Administrator;
use App\Student;
use App\StudentToken;
use App\Token;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(Request $request) {
        //登录
        $username = $request->input('username');
        $password = $request->input('password');
        $administratorInfo = Administrator::where('username', '=', $username)->where('password', '=', $password)->where('isValid', '=', true)->first();
        if ($administratorInfo) {
            $token = new Token();
            $token->token = str_random(18) . date('YmdHis');
            $token->administrator_id = $administratorInfo->id;
            $token->expiredTime = date("Y-m-d H:i:s", strtotime("+30 day"));
            $token->isValid = true;
            $token->save();
            return response()->json([
                'status' => 'OK',
                'content' => ['token' => $token->token]
            ]);
        } else {
            return response()->json([
                'status' => 'ERROR',
                'content' => "用户名或密码有误"
            ]);
        }
    }

    public function logout(Request $request) {
        //退出
        $postToken = $request->input('token');
        $tokens = Token::where('token', '=', $postToken)->first();
        if ($tokens) {
            Token::where('token', '=', $postToken)->update(['isValid' => false]);
            return response()->json([
                'status' => 'OK',
                'content' => ""
            ]);
        } else {
            return response()->json([
                'status' => 'NOT_LOGGED_IN',
                'content' => ""
            ]);
        }
    }
    public function studentLogin(Request $request){

        $studentNum = $request->input('studentNum');
        $password = $request->input('password');
        $studentInfo = Student::where('studentNum', '=', $studentNum)->where('password', '=', $password)->where('isValid', '=', true)->first();
        if ($studentInfo) {
            $token = new StudentToken();
            $token->token = str_random(18) . date('YmdHis');
            $token->student_id = $studentInfo->id;
            $token->expiredTime = date("Y-m-d H:i:s", strtotime("+1 day"));
            $token->isValid = true;
            $token->save();
            return response()->json([
                'status' => 'OK',
                'content' => ['token' => $token->token]
            ]);
        } else {
            return response()->json([
                'status' => 'ERROR',
                'content' => $request->input()
            ]);
        }
    }
    public function studentLogout(Request $request) {
        //退出
        $postToken = $request->input('studentToken');
        $tokens = StudentToken::where('token', '=', $postToken)->first();
        if ($tokens) {
            StudentToken::where('token', '=', $postToken)->update(['isValid' => false]);
            return response()->json([
                'status' => 'OK',
                'content' => ""
            ]);
        } else {
            return response()->json([
                'status' => 'NOT_LOGGED_IN',
                'content' => ""
            ]);
        }
    }

}
