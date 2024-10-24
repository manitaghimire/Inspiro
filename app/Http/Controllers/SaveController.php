<?php

namespace App\Http\Controllers;

use App\Models\save;
use App\Models\upload;
use Illuminate\Http\Request;

class SaveController extends Controller
{
    public function store(Upload $upload)
    {
        save::create(
            [
                'upload_id'=>$upload->id,
                'user_id'=>auth()->id()
            ]
            );
            return redirect()->route('uploads.show', $upload->id);
            //redirect to the my saved page
    }
    public function destroy(Upload $upload)
    {
        $save=Save::where('upload_id',$upload->id)->where('user_id', auth()->id())->first();
        $save->delete();
        return redirect()->route('uploads.show', $upload->id);
    }
}
