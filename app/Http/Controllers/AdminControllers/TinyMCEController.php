<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TinyMCEController extends Controller
{
    public function upload_tinymce_image(Request $request)
    {
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $path = $file->storeAs('tinymce_uploads', $filename, 'public');

        return response()->json([
            'location' => "/storage/$path",
        ]);
    }

    public function upload(Request $request)
    {
        $fileName = $request->file('file')->getClientOriginalName();
        $path = $request->file('file')->storeAs('tinymce_uploads', $fileName, 'public');
        return response()->json(['location' => "/storage/$path"]);

        /*$imgpath = request()->file('file')->store('uploads', 'public'); 
        return response()->json(['location' => "/storage/$imgpath"]);*/
    }

}
