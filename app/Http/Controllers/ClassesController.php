<?php

namespace App\Http\Controllers;

use App\AdministratorClasses;
use App\Classes;
use App\ClassesCourse;
use App\MajorAdministrator;
use App\Student;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ClassesController extends Controller
{
    public function addClassesByMajorId(Request $request){
        $classes = new Classes();
        $classes->major_id = $request->input('major_id');
        $classes->className = $request->input('className');
        $classes->sequence = $request->input('sequence');
        $classes->save();
        return response()->json([
            'status' => 'OK',
            'content' => ''
        ]);

    }
    public function deleteClassesById(Request $request){
        $id = $request->input('id');

        $student = Student::where('class_id','=',$id)->get();
        if($student){
            return response()->json([
                'status' => 'ERROR',
                'content' => "不存在此id的班级"
            ]);
        }else {
            $deleteResult = Classes::where('id','=',$id)->delete();
            AdministratorClasses::where('class_id','=',$id)->delete();
            ClassesCourse::where('class_id','=',$id)->delete();
            return response()->json([
                'status' => 'OK',
                'content' => ""
            ]);
        }

    }
    public function modifyClassesById(Request $request){
        $id = $request->input('id');
        $classes = Classes::where('id','=',$id)->first();
        if($classes) {
            $classes->className = $request->input('className');
            $classes->sequence = $request->input('sequence');
            $classes->save();
            return response()->json([
                'status' => 'OK',
                'content' => ""
            ]);
        }else {
            return response()->json([
                'status' => 'ERROR',
                'content' => "不存在此id的专业"
            ]);
        }
    }
    public function getAllClassesByMajorId(Request $request){
        $major_id = $request->input('major_id');
        $classes = Classes::where('major_id','=',$major_id)->get();
        if($classes){
            return response()->json([
                'status' => 'OK',
                'content' => $classes
            ]);
        }else{
            return response()->json([
                'status' => 'ERROR',
                'content' => '没有与此对应的专业'
            ]);
        }


    }
}
