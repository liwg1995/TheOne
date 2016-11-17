<?php

namespace App\Http\Controllers;

use App\Homework;
use App\StudentHomework;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use ZipArchive;

class DownloadFileController extends Controller
{

    public function getDownloadFile(Request $request)
    {
        $filename = $request->downloadFilename;
        $file = public_path() . "/uploads/" . $filename;
        return Response::download($file);
    }

    public function getHomeworkPack(Request $request)
    {
        $homework_id = $request->homeworkId;
        $homework_name = Homework::where('id', '=', $homework_id)->pluck('homeworkName');
        $zip = new ZipArchive();
        $path = public_path() . '/' . "uploads/" . $homework_name . $homework_id . ".zip";
        if ($zip->open($path, ZipArchive::OVERWRITE || ZipArchive::OVERWRITE) !== TRUE) {
            die ("An error occurred creating your ZIP file.");
        }
        $filePaths = StudentHomework::where('homework_id', '=', $homework_id)->where('isSubmit', '=', true)->get()->pluck('homeworkSubAddress')->toArray();
//        var_dump($filePaths);
        if(!$filePaths){
            return view("noSuchFile");
        }
        foreach ($filePaths as $filePath) {

            if (file_exists($filePath)) {

                $zip->addFile(public_path() . '/' . "$filePath");
            } else {

                die(" $filePath 文件不存在,无法提供下载");
            }
        }

        $zip->close();

        $headers = array(
            'Content-Type: application/zip',
        );

        $file = $path;
        $response = new BinaryFileResponse($file, 200, $headers, true);
        if(!$response){

        }
        $disposition = 'attachment';
        $name = basename($file);
        if($name) {

            ob_clean();
            return $response->setContentDisposition($disposition, $name, Str::ascii($name));
        }else{
            return view('error');
        }
    }

}
