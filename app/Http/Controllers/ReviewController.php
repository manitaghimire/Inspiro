<?php

namespace App\Http\Controllers;

use App\Models\review;
use App\Models\upload;
use Illuminate\Http\Request;
use App\Http\Requests\StoreReviewRequest;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request, Upload $upload)
    {
        //
        $validatedData=$request->validated();
        $validatedData['user_id']=auth()->id();
        $validatedData['upload_id']=$upload->id;
        Review::create($validatedData);
        $upload->increment('reviews');
        $averageRating=$upload->reviewCollection()->avg('rating');
        $upload->update([
            'average_rating'=>$averageRating
        ]);
        return redirect()->route('uploads.show',$upload->id)->with('success', 'Review added successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Upload $upload, review $review)
    {
        //
        $review->delete();
        $upload->decrement('reviews');
        $averageRating = $upload->reviewCollection()->avg('rating') ?? 0;
        $upload->update([
            'average_rating'=>$averageRating
        ]);
        return back()->with('success', 'Review removed successfully!');
    }
}
