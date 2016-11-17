<?php

namespace App\Http\Controllers;

use App\Department;
use App\Institute;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class InstituteController extends Controller
{
    //添加学院信息
    public function addInstitute(Request $request){
        $instituteName = $request->input('instituteName');
        $sequence = $request->input('sequence');
        $institute = new Institute();
        $institute->instituteName = $instituteName;
        $institute->sequence = $sequence;
        $institute->save();
        return response()->json([
            'status' => 'OK',
            'content' => ""
        ]);
    }
    public function deleteInstituteById(Request $request){
        $id = $request->input('id');
        $department = Department::where('institute_id','=',$id)->first();
        if($department){

            return response()->json([
                'status' => 'ERROR',
                'content' => "此学院下有对应的系,无法删除"
            ]);
        }else {
            $deleteResult = Institute::where('id','=',$id)->delete();
            return response()->json([
                'status' => 'OK',
                'content' => ""
            ]);

        }
    }
    public function modifyInstituteById(Request $request){
        $id = $request->input('id');

        $institute = Institute::where('id','=',$id)->first();
        if($institute){
            $institute->instituteName = $request->input('instituteName');
            $institute->sequence = $request->input('sequence');
            $institute->save();
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
    public function getAllInstitute(Request $request){
        $institutes = Institute::orderBy('sequence','asc')->get();
        return response()->json([
            'status' => 'OK',
            'content' => $institutes
        ]);
    }
}
