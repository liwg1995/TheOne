<?php
/**
* @file ChapterController.php
* @brief 章节信息增删改查
* @author Zeaone, zeaone@qq.com
* @version 1
* @date 2016-11-13
*/

namespace App\Http\Controllers;

use App\Chapter;
use App\Course;
use App\Section;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ChapterController extends Controller
{
    
    /**
    * @brief addChapterByCourseId 增加章节信息
    *
    * @param $request
    *
    * @return 
    */
    public function addChapterByCourseId(Request $request){
        $chapter = new Chapter();
        $chapter->course_id = $request->input('course_id');
        $chapter->chapterName = $request->input('chapterName');
        $chapter->sequence = $request->input('sequence');
        $chapter->save();
        return response()->json([
            'status' => 'OK',
            'content' => ''
        ]);
    }
    public function deleteChapterById(Request $request){
        $id = $request->input('id');

        $section = Section::where('chapter_id','=',$id)->first();
        if($section){
            return response()->json([
                'status' => 'ERROR',
                'content' => "此章下还有节,请依次删除"
            ]);
        }else {
            $chapter = Chapter::where('id','=',$id)->delete();
            return response()->json([
                'status' => 'OK',
                'content' => ""
            ]);
        }
    }
    public function modifyChapterById(Request $request){
        $id = $request->input('id');
        $chapter = Chapter::where('id','=',$id)->first();
        if($chapter){
            $chapter->chapterName = $request->input('chapterName');
            $chapter->sequence = $request->input('sequence');
            $chapter->save();
            return response()->json([
                'status' => 'OK',
                'content' => ""
            ]);
        }else {
            return response()->json([
                'status' => 'ERROR',
                'content' => "不存在此节"
            ]);
        }
    }
    public function getAllChapterByCourseID(Request $request){
        $course_id = $request->input('course_id');
        $chapters = Chapter::where('course_id','=',$course_id)->get();
        if($chapters){

            return response()->json([
                'status' => 'OK',
                'content' => $chapters
            ]);
        }else {
            return response()->json([
                'status' => 'ERROR',
                'content' => "没有对应章"
            ]);
        }
    }
}
