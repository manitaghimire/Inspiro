<?php

namespace App\Http\Controllers;

use App\Models\upload;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\tag;
use App\Http\Requests\StoreUploadsRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;



class UploadsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use AuthorizesRequests;

    
    public function index()
    {
        $uploads=Upload::with(['user','category','tags'])->where('user_id',auth()->id())->orderBy('created_at', 'desc')->get();
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
    try {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->id();

        if ($request->hasFile('imageurl')) {
            $file = $request->file('imageurl');
            $filepath = $file->store('uploads', 'public');
            $validatedData['imageurl'] = $filepath;
        }

        $upload = Upload::create($validatedData);

        if ($request->has('tags')) {
            foreach ($validatedData['tags'] as $tag) {
                Tag::create([
                    'upload_id' => $upload->id,
                    'tag' => $tag
                ]);
            }
        }
        return redirect()->route('dashboard')->with('success', 'Upload created successfully!');

    } catch (\Exception $e) {
        \Log::error('Upload creation error: '.$e->getMessage());
        return redirect()->back()->withErrors(['msg' => 'An error occurred while saving the upload. Please try again.']);
    }
}

    

    /**
     * Display the specified resource.
     */
    public function show(upload $upload)
    {
        //
        $upload->load('reviewCollection.user');
        $sortedReviews = $upload->reviewCollection->sortByDesc('created_at');
        // $upload->load('saveCollection');
        $currentUserSave=$upload->saveCollection()->where('user_id',auth()->id())->first();
        $userReview = $upload->reviewCollection->where('user_id', auth()->id())->first();
        $tags=$upload->tags;
        return view('uploads.view',compact('upload','tags', 'currentUserSave', 'userReview', 'sortedReviews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(upload $upload)
    {
        //
        $this->authorize('update',$upload);
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
        $this->authorize('update',$upload);
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
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(upload $upload)
    {
        $this->authorize('delete',$upload);
        $upload->delete();
        return redirect()->route('dashboard')->with('success', 'Post successfully deleted!');
    }

    public function search(Request $request )
    {
        $keyword=$request->query('query');
        $uploads = Upload::with(['user', 'category', 'tags'])
        ->where('title', 'LIKE', "%{$keyword}%")
        ->orWhere('caption', 'LIKE', "%{$keyword}%")
        ->get();
        if (auth()->check()) {
            $userId = auth()->id();
            
            $uploads->load(['saveCollection' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            }]);
        }
        return view('uploads.search',compact('uploads', 'keyword'));
    
    }
    public function tagSearch($tagname)
    {
        $tag = Tag::where('tag', $tagname)->firstOrFail();
        $uploads=$tag->upload()->with(['user','category','tags'])->get();
        if (auth()->check()) {
            $userId = auth()->id();
            
            $uploads->load(['saveCollection' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            }]);
        }
        return view('uploads.tagsearch',compact('uploads','tag'));
    }
}
