<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function uploads(Request $request){

        $uploadedFile=$request->file('video_id');
        $filename=time().$uploadedFile->getClientOriginalName();
        $original_name=$uploadedFile->getClientOriginalName();
        Storage::disk('local')->putFileas(
            'public/videos/'.Carbon::now()->year.'/admin',$uploadedFile,$filename
        );
        $video=new Video();
        $video->original_name=$original_name;
        $video->path=$filename;
        $video->user_id=1;
        $video->save();
        return response()->json([
            'video_id'=>$video->id
        ]);

    }
}
