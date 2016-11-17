<?php

namespace App\Http\Controllers;

use App\Administrator;
use App\AdministratorCourse;
use App\Chapter;
use App\ClassesCourse;
use App\Course;
use App\Homework;
use App\Resource;
use App\Section;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{

//    public function showALLCourse(){
//        return view('allCourse');
//    }
    public function showCourseInfo(Request $request){
        $course_id =$request->courseId;
        $data['chapters'] = Chapter::where('course_id','=',$course_id)->get()->toArray();
        $i = 0;
        foreach($data['chapters'] as $chapter){
            $data['sections'][$i]    = Section::where('chapter_id','=',$chapter['id'])->get()->toArray();
            $i++;
        }
        $data['course'] = Course::where('id','=',$course_id)->first();
        $data['homeworks'] = Homework::where('course_id','=',$course_id)->orderBy('sequence')->get()->toArray();
        echo "<pre>";
        print_r($data['homeworks']);
        echo "</pre>";
        return view('courseInfo',$data);
    }
    public function  watchVideo(Request $request){

        $section_id = $request->sectionId;
        $section = Section::where('id','=',$section_id)->first();
        $data['section'] = $section;
        $data['resources'] = Resource::where('section_id','=',$section_id)->get()->toArray();
        return view('watchVideo',$data);
    }
    public function addCourse(Request $request){//改:原名:addCourseByAdministratorId
        $course = new Course();
        $course->courseName = $request->input('courseName');
        $course->courseIntro = $request->input('courseIntro');
        $course->coursePicture = $request->input('coursePicture');
        $course->sequence = $request->input('sequence');
        $course->save();
        $course_id = $course->id;
        $administrator_id = $request->administrator_id;
        $administratorCourse = new AdministratorCourse();
        $administratorCourse->course_id = $course_id;
        $administratorCourse->administrator_id = $administrator_id;
        $administratorCourse->save();
        return response()->json([
            'status' => 'OK',
            'content' =>""
        ]);
    }
    public function deleteCourseById(Request $request){
        $id = $request->input('id');
        $chapter = Chapter::where('course_id','=',$id)->first();
        if($chapter){
            return response()->json([
                'status' => 'ERROR',
                'content' => "此课程下还有章节,请依次删除"
            ]);
        }else {
            $picAdd = Course::where('id','=',$id)->pluck('coursePicture');
            unlink(public_path().'/'.$picAdd);
            $course = Course::where('id','=',$id)->delete();
            AdministratorCourse::where('course_id','=',$id)->delete();
            ClassesCourse::where('course_id','=',$id)->delete();
            return response()->json([
                'status' => 'OK',
                'content' => ""
            ]);
        }


    }
    public function modifyCourseById(Request $request){
        $course = Course::where('id','=',$request->input('id'))->first();
        if($course) {
            if($course->coursePicture!=$course->coursePicture) {
                unlink(public_path() . '/' . $course->coursePicture);
            }
            $course->courseName = $request->input('courseName');
            $course->courseIntro = $request->input('courseIntro');
            $course->coursePicture = $request->input('coursePicture');
            $course->sequence = $request->input('sequence');
            $course->save();
            return response()->json([
                'status' => 'OK',
                'content' => ""
            ]);
        }else {
            return response()->json([
                'status' => 'ERROR',
                'content' => "不存在此课程"
            ]);
        }

    }
    public function getAllCoursesByAdministratorId(Request $request){//增加此方法
        $administrator_id = $request->administrator_id;
        $courses = Administrator::find($administrator_id)->course;
        return response()->json([
            'status' => 'OK',
            'content' => $courses
        ]);
    }

}
