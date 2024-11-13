<?php

namespace App\Http\Controllers;

use App\Models\save;
use App\Models\upload;
use Illuminate\Http\Request;

class SaveController extends Controller
{
    public function index()
    {
        $saved=Save::with(['upload.user', 'upload.category', 'upload.tags'])->where('user_id',auth()->id())->get();
        return view('savedpost', compact('saved'));
    }
    public function store(Upload $upload)
    {
        save::create(
            [
                'upload_id'=>$upload->id,
                'user_id'=>auth()->id()
            ]
            );
            $upload->increment('saves');

            return redirect()->route('saves')->with('success', 'Post added to save collection!');;
            //redirect to the my saved page
    }
    public function destroy(Upload $upload)
    {
        $save=Save::where('upload_id',$upload->id)->where('user_id', auth()->id())->first();
        $save->delete();
        $upload->decrement('saves');
        return back()->with('success', 'Save removed successfully!');

    }
}
