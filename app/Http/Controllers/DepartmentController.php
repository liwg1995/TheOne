<?php

namespace App\Http\Controllers;

use App\Department;
use App\Major;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function addDepartmentByInstituteId(Request $request){
        $department = new Department();
        $department->institute_id = $request->input('institute_id');
        $department->departmentName = $request->input('departmentName');
        $department->sequence = $request->input('sequence');

        $department->save();
        return response()->json([
            'status' => 'OK',
            'content' => ''
        ]);
    }
    public function deleteDepartmentById(Request $request){
        $id = $request->input('id');
        $major = Major::where('department_id','=',$id)->first();
        if($major){

            return response()->json([
                'status' => 'ERROR',
                'content' => "不存在此id的学院"
            ]);
        }else {
            $deleteResult = Department::where('id','=',$id)->delete();
            return response()->json([
                'status' => 'OK',
                'content' => ""
            ]);

        }
    }
    public function modifyDepartmentById(Request $request){
        $id = $request->input('id');
        $department = Department::where('id','=',$id)->first();
        if($department) {
            $department->departmentName = $request->input('departmentName');
            $department->sequence = $request->input('sequence');
            $department->save();
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
    public function getAllDepartmentByInstituteId(Request $request){
        $institute_id = $request->input('institute_id');
        $departments = Department::where('institute_id','=',$institute_id)->orderBy('sequence','asc')->get();
        if($departments) {
            return response()->json([
                'status' => 'OK',
                'content' => $departments
            ]);
        }else{
            return response()->json([
                'status' => 'ERROR',
                'content' => '没有与此对应的系'
            ]);
        }
    }

}
