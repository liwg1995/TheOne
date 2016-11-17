<?php

namespace App\Http\Controllers;

use App\AdministratorCourse;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdministratorAndCourseController extends Controller
{
    public function addAdministratorAndCourse(Request $request){

        $administratorAndCourse = new AdministratorCourse();
        $administratorAndCourse->administrator_id = $request->input('administrator_id');
        $administratorAndCourse->course_id = $request->input('course_id');
        $administratorAndCourse->save();
        return response()->json([
            'status' => 'OK',
            'content' => ''
        ]);
    }
    public function deleteAdministratorAndCourse(Request $request){
        $administrator_id = $request->input('administrator_id');
        $course_id = $request->input('course_id');
        $administratorAndCourse = AdministratorCourse::where('administrator_id','=',$administrator_id)->where('course_id','=',$course_id)->delete();
        if($administratorAndCourse){
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
    public function getAllAdministratorAndCourse(Request $request){
        $administrator_id = $request->input('administrator_id');
        $course = Administrator::find($administrator_id)->course;
        return response()->json([
            'status' => 'OK',
            'content' => $course
        ]);
    }
}
