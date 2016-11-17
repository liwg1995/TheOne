<?php

namespace App\Http\Controllers;

use App\Administrator;
use App\MajorAdministrator;
use App\Student;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
class ImportController extends Controller
{
    public function importAdministrator(Request $request){
        $major_id = $request->input('major_id');
        $teachers = $request->input('teachers');
        $validator = Validator::make(
            [
                'major_id'=>$major_id,
                'teachers'=>$teachers
            ],
            [
                'major_id'=>'required',
                'teachers'=>'required'
            ]
        );
        if(!$validator->fails()) {
            foreach ($teachers as $teacher) {
                $administrator = new Administrator();
                $administrator->username = $teacher['username'];
                $administrator->password = $teacher['username'];
                $administrator->nickname = $teacher['name'];
                $administrator->isValid = true;
                $administrator->save();
                $majorAdministrator = new MajorAdministrator();
                $majorAdministrator->major_id = $major_id;
                $majorAdministrator->administrator_id = $administrator->id;
                $majorAdministrator->save();
            }
            return response()->json([
                'status' => 'OK',
                'content' => ""
            ]);
        }else{
            return response()->json([
                'status' => 'ERROR',
                'content' => "您填的信息有误"
            ]);
        }
    }
    public function importStudent(Request $request){
        $class_id = $request->input('class_id');
        $students = $request->input('students');

        $validator = Validator::make(
            [
                'class_id'=>$class_id,
                'students'=>$students
            ],
            [
                'class_id' =>'required',
                'students'=>'required'
            ]
        );
        if(!$validator->fails()) {
            foreach($students as $student){
                $studentInstance = new Student();
                $studentInstance->class_id = $class_id;
                $studentInstance->studentNum = $student['card'];
                $studentInstance->password = $student['card'];
                $studentInstance->studentName = $student['name'];
                $studentInstance->isValid = true;
                $studentInstance->save();
            }
            return response()->json([
                'status' => 'OK',
                'content' => ""
            ]);
        }else{
            return response()->json([
                'status' => 'ERROR',
                'content' => "您填的信息有误"
            ]);
        }

    }
}
