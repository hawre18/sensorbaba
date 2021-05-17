<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function uploads(Request $request){

        $uploadedFile=$request->file('file');
        $filename=time().$uploadedFile->getClientOriginalName();
        $original_name=$uploadedFile->getClientOriginalName();
        Storage::disk('local')->putFileas(
            'public/photos/'.Carbon::now()->year.'/admin',$uploadedFile,$filename
        );
        $photo=new Photo();
        $photo->original_name=$original_name;
        $photo->path=$filename;
        $photo->user_id=1;
        $photo->save();
        return response()->json([
            'photo_id'=>$photo->id
        ]);

    }
}
