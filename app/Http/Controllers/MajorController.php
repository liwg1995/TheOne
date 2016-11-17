<?php
/**
* @file MajorController.php
* @brief :
* @author Zeaone, zeaone@qq.com
* @version 1.1.1
* @date 2016-11-13
*/

namespace App\Http\Controllers;

use App\Classes;
use App\Major;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MajorController extends Controller
{
    
    /**
    * @brief addMajorByDepartmentId 通过部门id添加专业id
    *
    * @param $request
    *
    * @return 
    */
    public function addMajorByDepartmentId(Request $request){
        $major = new Major();
        $major-> department_id= $request->input('department_id');
        $major->majorName = $request->input('majorName');
        $major->sequence = $request->input('sequence');
        $major->save();
        return response()->json([
            'status' => 'OK',
            'content' => ''
        ]);

    }
    public function deleteMajorById(Request $request){
        $id = $request->input('id');
        $class = Classes::where('major_id','=',$id)->first();

        if($class){

            return response()->json([
                'status' => 'ERROR',
                'content' => "不存在此id的专业"
            ]);
        }else {
            $deleteResult = Major::where('id','=',$id)->delete();
            return response()->json([
                'status' => 'OK',
                'content' => ""
            ]);

        }

    }
    public function modifyMajorById(Request $request){
        $id = $request->input('id');
        $major =  Major::where('id','=',$id)->first();
        if($major){
            $major->majorName = $request->input('majorName');
            $major->sequence = $request->input('sequence');
            $major->save();
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
    public function getAllMajorByDepartmentId(Request $request){
        $department_id = $request->input('department_id');
        $major = Major::where('department_id','=',$department_id)->OrderBy('sequence','asc')->get();
        if($major){
            return response()->json([
                'status' => 'OK',
                'content' => $major
            ]);
        }else{
            return response()->json([
                'status' => 'ERROR',
                'content' => '没有与此对应的专业'
            ]);
        }

    }
}
