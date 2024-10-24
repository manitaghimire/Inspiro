
@extends('layouts.navigation2')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @csrf    
                    @method('PUT')       

                    <b>Title:</b><br>
                    {{$upload->title}}
                    <br><br>      

                    <b>Description:</b><br>
                    {{$upload->caption}}<br><br>                    
            
                    <b>Image: </b><br/>
                    @if ($upload->imageurl)
                        <img src="{{ asset('storage/' . $upload->imageurl) }}" alt="Icon" style="width: 100px; height: auto;"><br>
                    @endif
                    <br><br>

                    <b>Category</b>
                    {{$upload->category->catname}}
                    <br><br>

                    <b>Link:</b><br>
                    {{$upload->link}}
                    <br><br>

                    <b>Tags:</b><br>
                    <div id="tag-container">
                        @if ($tags && $tags->count() > 0)
                            @foreach ($tags as $tag)
                                <div style="margin-bottom: 10px;">
                                    {{$tag->tag}}                                
                                </div>
                            @endforeach
                        @endif
                    </div>
                    @if($upload->saveCollection->isNotEmpty())
                    <form action="{{route('upload.unsave', $upload)}}" method="post" >
                        @csrf
                        @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" >
                       unsave
                    </button>
                    </form>
                    @else
                        <form action="{{route('upload.save', $upload)}}" method="post">
                            @csrf
                            
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                       Save
                    </button>
                    </form>
                    @endif
                    <br>

                    <!-- Rating and Review Section -->
                    <h4>Leave a Rating and Review</h4>
                    <form action="{{ route('uploads.reviews.store', $upload) }}" method="POST">
                        @csrf
                        
                        <!-- Star Rating -->
                        <div class="rating mb-3">
                            <b>Rating: </b>
                            <div class="stars">
                                <input type="radio" name="rating" id="star1" value="5">
                                <label for="star1" class="fas fa-star"></label>

                                <input type="radio" name="rating" id="star2" value="4">
                                <label for="star2" class="fas fa-star"></label>

                                <input type="radio" name="rating" id="star3" value="3">
                                <label for="star3" class="fas fa-star"></label>

                                <input type="radio" name="rating" id="star4" value="2">
                                <label for="star4" class="fas fa-star"></label>

                                <input type="radio" name="rating" id="star5" value="1">
                                <label for="star5" class="fas fa-star"></label>
                            </div>
                        </div>

                        <!-- Comment -->
                        <div class="mb-3">
                            <b>Review:</b>
                            <textarea class="form-control" name="comment" rows="4" placeholder="Write your review here..."></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Submit Review</button>
                    </form>
                    <br>
                    <!-- showin existing reviews and ratings -->
                     <b>Comments and Ratings by other users</b>
                     <!-- @if($upload->reviews){
                     @foreach($upload->reviews as $review)
                        {{$review->upload_id}} <br>
                       {{$review->user_id}} <br>
                        {{$review->rating}}<br>
                       {{ $review->comment }}<br>
                        {{$review->created_at}} <br>
                        {{$review->updated_at}} <br>
                     @endforeach}
                     @else
                        No comments                     
                     @endif -->
                     @foreach($upload->reviewCollection as $review)
                     {{$review->upload_id}} <br>
                       {{$review->user->name}} <br>
                        {{$review->rating}}<br>
                       {{ $review->comment }}<br>
                        {{$review->created_at}} <br>
                        {{$review->updated_at}} <br>
                        @endforeach


                     
                </div>
            </div>
        </div>
    </div>
   

    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <!-- Rating Stars CSS -->
    <style>
        .stars {
            display: inline-block;
            direction: rtl; 
        }

        .stars input[type="radio"] {
            display: none;
        }

        .stars label {
            font-size: 1rem;
            color: gray;
            cursor: pointer;
            margin: 0; 
        }

        .stars label:hover,
        .stars label:hover ~ label {
            color: gold; /* Highlight stars on hover */
        }

        .stars input[type="radio"]:checked ~ label {
            color: gold; /* Color stars after selection */
        }

        /* Ensure all previous stars light up correctly */
        .stars input[type="radio"]:checked + label,
        .stars input[type="radio"]:checked + label ~ label {
            color: gold;
        }
    </style>
  

