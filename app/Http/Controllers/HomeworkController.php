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

class HomeworkController extends Controller
{
    public function addHomeworkByCourseId(Request $request){
        $homework  = new Homework();
        $homework->course_id = $request->input('course_id');
        $homework->homeworkName = $request->input('homeworkName');
        $homework->homeworkAddress = $request->input('homeworkAddress');
        $homework->expiredTime = $request->input('expiredTime');
        $homework->sequence = $request->input('sequence');
        $homework->save();
        $homework_id = $homework->id;
        $classesIds = Course::find($request->input('course_id'))->classes->pluck('id')->toArray();
//        foreach($classesIds as $classesId){
//            $studentIds[$classesId] = Student::where('class_id','=',$classesId)->
//        }
        for($i = 0 ;$i<count($classesIds);$i++){
            $students[$i] = Student::where('class_id','=',$classesIds[$i])->get()->toArray();
        }
//        print_r($students);
        for($i = 0 ;$i<count($classesIds);$i++){
            foreach($students[$i] as $student){
                $a = new StudentHomework();
                $a->student_id = $student['id'];
                $a->homework_id = $homework_id;
                $a->isSubmit = false;
                $a->save();
            }

        }

        return response()->json([
            'status'=>'OK',
            'content'=>''
        ]);

    }
    public function deleteHomeworkById(Request $request){

        $homeworkAdd = Homework::where('id','=',$request->id)->pluck('homeworkAddress');
        $a = Homework::where('id','=',$request->id)->delete();
        if($a){
            unlink(public_path().'/'.$homeworkAdd);
            StudentHomework::where('homework_id','=',$request->id)->delete();
            return response()->json([
                "status"=>"OK",
                "content"=>""
            ]);
        }else{
            return response()->json([
                "status"=>"ERROR",
                "content"=>"不存在这个id的作业"
            ]);

        }
    }
    public function modifyHomeworkById(Request $request){
        $homework = Homework::where('id','=',$request->id)->first();
        if($homework->homeworkAddress!=$request->homeworkAddress){
            unlink(public_path().'/'.$homework->homeworkAddress);
        }
        $homework->course_id = $request->input('course_id');
        $homework->homeworkName = $request->input('homeworkName');
        $homework->expiredTime = $request->input('expiredTime');
        $homework->homeworkAddress = $request->input('homeworkAddress');
        $homework->sequence = $request->input('sequence');
        $homework->save();
        return response()->json([
            'status'=>'OK',
            'content'=>''
        ]);

    }
    public function getAllHomeworkByCourseID(Request $request){
        $homeworks = Homework::where('course_id','=',$request->course_id)->get()->toArray();
       // var_dump($homeworks);
        return response()->json([
            'status'=>'OK',
            'content'=>$homeworks
        ]);


    }

}
