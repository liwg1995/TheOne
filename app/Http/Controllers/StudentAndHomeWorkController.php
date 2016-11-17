<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Homework;
use App\Student;
use App\StudentHomework;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class StudentAndHomeWorkController extends Controller
{
    public function getStudentAndHomeWorkByHomeworkId(Request $request)
    {
        $studentHomeworks = StudentHomework::where('homework_id', '=', $request->input('homework_id'))->orderBy('isSubmit','desc')->get()->toArray();
        if ($studentHomeworks == null) {
            return response()->json([
                'status' => 'OK',
                'content' => ''
            ]);
        }
        for ($i = 0; $i < count($studentHomeworks); $i++) {
            //把学生姓名得到
            $studentHomeworks[$i]['studentName'] = Student::where('id', '=', $studentHomeworks[$i]['student_id'])->pluck('studentName');
            $studentHomeworks[$i]['className'] = Classes::where('id', '=', Student::where('id', '=', $studentHomeworks[$i]['student_id'])->pluck('class_id'))->pluck('className');
        }
        return response()->json([
            'status' => 'OK',
            'content' => $studentHomeworks
        ]);


    }

    public function modifyStudentAndHomeWorkByHomeworkId(Request $request)
    {
        $StudentAndHomeWork = StudentHomework::where('id', '=', $request->input('id'))->first();
        $StudentAndHomeWork->score = $request->input('score');
        $StudentAndHomeWork->comment = $request->input('comment');
        $StudentAndHomeWork->save();
        return response()->json([
            'status' => 'OK',
            'content' => ''
        ]);


    }
}
