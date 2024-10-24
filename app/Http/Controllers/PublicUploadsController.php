<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\upload;

class PublicUploadsController extends Controller
{
    //
    public function index()
    {
        $uploads=Upload::with(['user','category','tags'])->get();
        
            return view('welcome', compact('uploads'));
        
    }

    public function show(upload $upload)
    {
        //
        $upload->load('reviewCollection.user');
        $upload->load('saveCollection');
        
        $tags=$upload->tags;
        return view('uploads.view',compact('upload','tags'));
    }
}
