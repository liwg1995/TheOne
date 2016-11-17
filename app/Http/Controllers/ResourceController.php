<?php

namespace App\Http\Controllers;

use App\Resource;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ResourceController extends Controller
{
    public function addResourceBySectionId(Request $request){
        $resource = new Resource();
        $resource->resourceName = $request->input('resourceName');
        $resource->resourceAddress = $request->input('resourceAddress');
        $resource->sequence = $request->input('sequence');
        $resource->section_id = $request->input('section_id');
        $resource->save();
        return response()->json([
            'status' => 'OK',
            'content' =>""
        ]);

    }
    public function deleteResourceById(Request $request){
        $resourceAdd = Resource::where('id','=',$request->input('id'))->pluck('resourceAddress');
        $deleteResult = Resource::where('id','=',$request->input('id'))->delete();
        if($deleteResult){
            unlink(public_path().'/'.$resourceAdd);
            return response()->json([
                'status' => 'OK',
                'content' => ""
            ]);
        }else {
            return response()->json([
                'status' => 'ERROR',
                'content' =>"不能存在此课程"
            ]);
        }
    }
    public function modifyResourceById(Request $request){
        $resource = Resource::where('id','=',$request->input('id'))->first();
        if($resource) {
            if($resource->resourceAddress!=$request->input('resourceAddress')) {
                unlink(public_path() . '/' . $resource->resourceAddress);
            }
            $resource->section_id = $request->input('section_id');
            $resource->resourceName = $request->input('resourceName');
            $resource->resourceAddress = $request->input('resourceAddress');
            $resource->sequence = $request->input('sequence');
            $resource->save();
            return response()->json([
                'status' => 'OK',
                'content' => $resource
            ]);
        }else{
            return response()->json([
                'status' => 'ERROR',
                'content' => "没有此数据"
            ]);
        }

    }
    public function getAllResourceBySectionId(Request $request){
        $resource = Resource::where('section_id','=',$request->input('section_id'))->get();
        return response()->json([
            'status' => 'OK',
            'content' => $resource
        ]);
    }
    public function getResourceById(Request $request){
        $resource = Resource::where('id','=',$request->id)->first();
        return response()->json([
            'status' => 'OK',
            'content' => $resource
        ]);
    }
}
