<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Excel;

class ExcelController extends Controller
{

    public function getExcelInfoAndReturn(Request $request){
        $filePath = 'app/storage/imports/'.iconv('UTF-8', 'GBK', $request->filename);

        $data = Excel::load($filePath,function($reader) {
//            $data = $reader->all()->toArray();
        })->get();
        return response()->json([
            'status' => 'OK',
            'content' => $data
        ]);
    }
    public function uploadExcel(Request $request){
        $file = $request->file('file');
        if($file -> isValid()){

            $extension = $file -> getClientOriginalExtension();
            $clientName = $file -> getClientOriginalName();

            $newName = md5(date('ymdhis').$clientName).".".$extension;
            $file -> move(app_path().'/storage/imports/',$newName);

            return response()->json([
                'status'=>'OK',
                'content'=>$newName
            ]);
        }
    }
}
