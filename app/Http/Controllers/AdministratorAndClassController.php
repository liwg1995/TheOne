<?php

namespace App\Http\Controllers;

use App\Administrator;
use App\AdministratorClasses;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdministratorAndClassController extends Controller
{
    public function addAdministratorAndClasses(Request $request){
        $administratorClasses = new AdministratorClasses();
        $administratorClasses->administrator_id = $request->input('administrator_id');
        $administratorClasses->class_id = $request->input('class_id');
        $administratorClasses->save();
        return response()->json([
            'status' => 'OK',
            'content' => ''
        ]);
    }
    public function deleteAdministratorAndClasses(Request $request){
        $administrator_id = $request->input('administrator_id');
        $class_id = $request->input('class_id');
        $administratorClasses = AdministratorClasses::where('administrator_id','=',$administrator_id)->where('class_id','=',$class_id)->delete();
        if($administratorClasses){
            return response()->json([
                'status' => 'OK',
                'content' => ""
            ]);
        }else {
            return response()->json([
                'status' => 'ERROR',
                'content' => "不存在此对应关系"
            ]);
        }

    }
    public function getAllAdministratorAndClasses(Request $request){
        $administrator_id = $request->input('administrator_id');
        $classes = Administrator::find($administrator_id)->classes;
        return response()->json([
            'status' => 'OK',
            'content' => $classes
        ]);

    }
}
