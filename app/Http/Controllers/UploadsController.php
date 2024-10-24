<?php

namespace App\Http\Controllers;

use App\Models\upload;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\tag;
use App\Http\Requests\StoreUploadsRequest;

class UploadsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $uploads=Upload::with(['user','category','tags'])->where('user_id',auth()->id())->get();
        return view('uploads.index',compact('uploads'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories=Category::all();
        return view('uploads.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUploadsRequest $request)
    {
        //
        $validatedData=$request->validated();
        $validatedData['user_id']=auth()->id();
        if($request->hasfile('imageurl'))
        {
            $file=$request->file('imageurl');
            $filepath=$file->store('uploads','public');
            $validatedData['imageurl']=$filepath;
        }
       
        $Upload=upload::create($validatedData);

        if($request->has('tags')){
        foreach($validatedData['tags'] as $tag)
        {
            Tag::create(
                [
                    'upload_id'=>$Upload->id,
                    'tag'=>$tag
                ]
                );
        }}
        return redirect()->route('uploads.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(upload $upload)
    {
        //
        $upload->load('reviewCollection.user');
        $upload->load('saveCollection');
        
        $tags=$upload->tags;
        return view('uploads.view',compact('upload','tags'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(upload $upload)
    {
        //
        $categories=Category::all();
        $tags=$upload->tags;
        return view('uploads.edit',compact('upload','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUploadsRequest $request, upload $upload)
    {
        //
        $validatedData=$request->validated();
        if($request->hasfile('imageurl'))
        {
            $filepath=$request->file('imageurl')->store('uploads','public');
            $validatedData['imageurl']=$filepath;
        }
        else
        {
            $validatedData['imageurl']=$upload->imageurl;
        }
        $upload->update($validatedData);
        if(isset($validatedData['tags']))
        {
            Tag::where('upload_id',$upload->id)->delete();
            foreach($validatedData['tags'] as $tag)
            {
                Tag::create(
                    [
                        'upload_id'=>$upload->id,
                        'tag'=>$tag
                    ]
                    );
            }
        }
        return redirect()->route('uploads.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(upload $upload)
    {
        $upload->delete();
        return redirect()->route('uploads.index');
    }
}
