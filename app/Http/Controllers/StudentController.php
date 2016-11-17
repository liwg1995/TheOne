<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Course;
use App\Homework;
use App\Student;
use App\StudentHomework;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Storage;
class StudentController extends Controller
{

    public function mySpace(Request $request){
        $student_id = $request->student_id;
        $class_id = Student::where('id','=',$student_id)->pluck('class_id');
        $data['courses'] = Classes::find($class_id)->course->toArray();
        return view('mySpace',$data);
    }
    public function myHomework(Request $request){
        $student_id = $request->student_id;
        $class_id = Student::where('id','=',$student_id)->pluck('class_id');
        $data['courses'] = Classes::find($class_id)->course->toArray();
        return view('myHomework',$data);
    }
    public function allHomework(Request $request){
        $course_id = $request->course_id;
        $homeworkIds = Homework::where('course_id','=',$course_id)->get()->pluck('id')->toArray();
        for($i = 0;$i<count($homeworkIds);$i++){
            if(StudentHomework::where('student_id','=',$request->student_id)->where('homework_id','=',$homeworkIds[$i])->first()==null){
                $submitInfo[$i] = null;
            }else{
                $submitInfo[$i] = StudentHomework::where('student_id','=',$request->student_id)->where('homework_id','=',$homeworkIds[$i])->first()->toArray();
            }
        }
        $homeworks = Homework::where('course_id','=',$course_id)->orderBy('sequence')->get()->toArray();
        for($i = 0;$i<count($homeworkIds);$i++){
            for($j = 0;$j<count($homeworkIds);$j++) {
                
                if($submitInfo[$i]['homework_id'] == $homeworks[$j]['id']) {
                    if($submitInfo[$i]['isSubmit']==0){
                        $homeworks[$j]['isSubmit'] = "否";
                    }else{
                        $homeworks[$j]['isSubmit'] = "是";
                    }
                    if($submitInfo[$i]['score']===null){
                        $homeworks[$j]['score'] = "未批阅";
                    }else{
                        $homeworks[$j]['score'] = $submitInfo[$i]['score'];
                    }
                    $homeworks[$j]['comment'] = $submitInfo[$i]['comment'];
                }
            }
        }
        $data['homeworks'] = $homeworks;
        return view('allHomework',$data);
    }
    public function getStudentInfo(Request $request){
        $student_id = $request->student_id;
        $class_id = Student::where('id','=',$student_id)->pluck('class_id');
        $className = Classes::where('id','=',$class_id)->pluck('className');
        $stuInfo['studentName'] = Student::where('id','=',$student_id)->pluck('studentName');
        $stuInfo['className'] = $className;
        return response()->json([
            'status' => 'OK',
            'content' => $stuInfo
        ]);
    }
   
    public function modifyStudentById(Request $request){

    }
    public function getAllStudentByClassId(Request $request){

    }

}
