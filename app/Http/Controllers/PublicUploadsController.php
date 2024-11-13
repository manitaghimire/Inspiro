<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\upload;
use App\Models\Category;

class PublicUploadsController extends Controller
{
    //
    public function index()
    {
            $mostSaved=Upload::with(['user','category','tags'])->orderBy('saves','desc')->take(3)->get();
            $mostReviewed=Upload::with(['user','category','tags'])->orderBy('reviews','desc')->take(3)->get();
            $categories = Category::with(['uploads' => function($query) {
                $query->with(['user', 'tags']) 
                    ->orderBy('average_rating', 'desc') 
                    ->take(3); 
            }])->get(); 
            
            if (auth()->check()) {
                $userId = auth()->id();
                
                $mostSaved->load(['saveCollection' => function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                }]);
        
                $mostReviewed->load(['saveCollection' => function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                }]);
        
                $categories->each(function ($category) use ($userId) {
                    $category->uploads->load(['saveCollection' => function ($query) use ($userId) {
                        $query->where('user_id', $userId);
                    }]);
                });
            }
            
            return view('welcome', compact('mostSaved','mostReviewed','categories'));
        
    }

    public function show(upload $upload)
    {
        //
        $upload->load('reviewCollection.user');
        $upload->load('saveCollection');
        $tags=$upload->tags;
        $userReview = $upload->reviewCollection->where('user_id', auth()->id())->first();
        return view('uploads.view',compact('upload','tags', 'userReview'));
        //not being used
    }
}
