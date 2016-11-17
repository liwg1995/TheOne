<?php

namespace App\Http\Controllers;

use App\Resource;
use App\Section;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SectionController extends Controller
{
    public function addSectionByChapterId(Request $request){
        $section = new Section();
        $section->chapter_id = $request->input('chapter_id');
        $section->sectionName = $request->input('sectionName');
        $section->videoAddress = $request->input('videoAddress');
        $section->sequence = $request->input('sequence');
        $section->save();
        return response()->json([
            'status' => 'OK',
            'content' => ''
        ]);
    }
    public function deleteSectionById(Request $request){
        $id = $request->input('id');

        $resource = Resource::where('section_id','=',$id)->first();
        if($resource){

            return response()->json([
                'status' => 'ERROR',
                'content' => "此节下还有资源.请删除"
            ]);
        }else{
            $videoAddress = Section::where('id','=',$id)->pluck('videoAddress');
            unlink(public_path().'/'.$videoAddress);
            $deleteResult = Section::where('id','=',$id)->delete();
            return response()->json([
                'status' => 'OK',
                'content' => ""
            ]);
        }

    }
    public function modifySectionById(Request $request){
        $id = $request->input('id');
        $section = Section::where('id','=',$id)->first();
        if($section) {
            if($section->videoAddress!=$request->input('videoAddress')){
                unlink(public_path() . '/' . $section->videoAddress);
            }
            $section->sectionName = $request->input('sectionName');
            $section->sequence = $request->input('sequence');
            $section->videoAddress = $request->input('videoAddress');
            $section->save();
            return response()->json([
                'status' => 'OK',
                'content' => ""
            ]);
        }else {
            return response()->json([
                'status' => 'ERROR',
                'content' => "不存在此id的学院"
            ]);
        }

    }
    public function getAllSectionByChapterId(Request $request){
        $chapter_id = $request->input('chapter_id');
        $sections = Section::where('chapter_id','=',$chapter_id)->get();
        if($sections) {
            return response()->json([
                'status' => 'OK',
                'content' => $sections
            ]);
        }else{
            return response()->json([
                'status' => 'ERROR',
                'content' => '没有与此对应的系'
            ]);
        }
    }

}
