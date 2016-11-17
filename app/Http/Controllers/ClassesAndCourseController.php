<?php

namespace App\Http\Controllers;

use App\Classes;
use App\ClassesCourse;
use App\Course;
use App\MajorAdministrator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ClassesAndCourseController extends Controller
{
    public function addClassesAndCourse(Request $request){
        $classes = $request->input();
//        return response()->json([
//            'status' => 'OK',
//            'content' => $classes
//        ]);
        foreach($classes as $class){
            if($class['selected']==true) {
                $classCourse = new ClassesCourse();
                $classCourse->course_id = $class['course_id'];
                $classCourse->class_id = $class['id'];
                $isUsable = ClassesCourse::where('course_id','=',$class['course_id'])->where('class_id','=',$class['id'])->first();
                if($isUsable){
                    continue;
                }else{
                    $classCourse->save();
                }
            }else{
                ClassesCourse::where('course_id','=',$class['course_id'])->where('class_id','=',$class['id'])->delete();
            }
        }
        return response()->json([
            'status' => 'OK',
            'content' => ""
        ]);
    }
    public function deleteClassesAndCourse(Request $request){
        $course_id = $request->input('course_id');
        $class_id =  $request->input('class_id');
        $classesCourse = ClassesCourse::where('course_id','=',$course_id)->where('class_id','=',$class_id)->delete();
        if($classesCourse){
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
    public function getAllClassesAndCourse(Request $request){
        $major_id = MajorAdministrator::where('administrator_id','=',$request->administrator_id)->pluck('major_id');
        $classes = Classes::where('major_id','=',$major_id)->get();//得到所有对应班级
        $course_id = $request->input('course_id');
        $classesAndCourses = Course::find($course_id)->classes;
        foreach($classes as $class){
            $flag = false;
            $class['course_id'] = $course_id;
            foreach($classesAndCourses as $classesAndCourse){
                if($class['id']==$classesAndCourse['id']){
                    $class['selected'] = true;
                    $flag = true;
                }
            }
            if($flag==false){
                $class['selected'] = false;
            }
        }
        return response()->json([
            'status' => 'OK',
            'content' => $classes
        ]);
//        $class_id =  $request->input('class_id');
//        $courses = Classes::find($class_id)->course;
//        return response()->json([
//            'status' => 'OK',
//            'content' => $courses
//        ]);
    }
}
