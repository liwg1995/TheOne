<?php

namespace App\Http\Controllers;

use App\Homework;
use App\StudentHomework;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    public function submitHomework(Request $request){
        $file = $request->file('myHomework');
        if(($file!=null)&&$file -> isValid()){
            $ex = $file -> getClientOriginalExtension();
            if(($ex=="zip")||($ex=="rar")||($ex=="tar")||($ex=="7z")){
                $homework_id = $request->input('homework_id');
                $homework_stu = StudentHomework::where('student_id','=',$request->student_id)->where('homework_id','=',$homework_id)->first();
                if($homework_stu->homeworkSubAddress!=null) {
                    unlink(public_path() . '/' . $homework_stu->homeworkSubAddress);
                }
                $clientName = $file -> getClientOriginalName();//本来的文件的名字
                $homeworkOrgName = Homework::where('id','=',$homework_id)->pluck('homeworkName');
                $newPath = "uploads/$homeworkOrgName"."$homework_id".'/'.$clientName;
                $file -> move("uploads/$homeworkOrgName"."$homework_id".'/',$clientName);
                $homework_stu->isSubmit = true;
                $homework_stu->homeworkName = $clientName;
                $homework_stu->homeworkSubAddress = $newPath;
                $homework_stu->save();
                return redirect("success/$request->token")->with('info',"文件上传成功");
            }else{
                return redirect("error/$request->token")->with('info',"文件上传失败");
            }
        }
        return redirect("error/$request->token")->with('info',"文件上传失败");
    }
    public function uploadFile(Request $request){
        $file = $request->file('file');
        if($file -> isValid()){
            $entension = $file -> getClientOriginalExtension();
            $clientName = $file -> getClientOriginalName();
            $newName = md5(date('ymdhis').$clientName).".".$entension;
            $newPath = 'uploads/'.$newName;
            $file -> move('uploads/',$newName);
            return response()->json([
                'status'=>'OK',
                'content'=>$newPath
            ]);
        }
        return response()->json([
            'filePath'=>"保存出错"
        ]);

    }
}
