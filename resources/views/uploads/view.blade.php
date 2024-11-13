@extends('layouts.navigation')
@section('title', 'Upload')
@section('content')  

<style>
    .scrollable-comments {
      max-height: 300px;
      overflow-y: auto;
    }

    .post-container {
      margin-top: 20px;
    }

   

    .post-image {
    width: 100%; 
    height: auto; 
    max-height: 700px;
    object-fit:cover;
     
    border-radius: 8px;
    margin-bottom:10px;
}

    .content-section {
      background-color: #f8f9fa;
      border-radius: 8px;
      padding: 15px;
      max-height: 700px;
      overflow-y:auto;
    }
    .rate
    {
        display: inline-block;
        -webkit-text-stroke: 1px black;
        color:#FFC83D;
    }
    .stars
    {
        color:gold;
        -webkit-text-stroke: 0px black;
    }
  </style>

<div class="container post-container">
    <div class="row g-4">
      
      <!-- Left Side: Image -->
      <div class="col-md-6">
        <img src="{{ asset('storage/' . $upload->imageurl) }}" alt="Icon" class="post-image">
      </div>
      

      <!-- Right Side: Content -->

      <div class="col-md-6">
        <div class="content-section">
        <div class="d-flex justify-content-between align-items-center">
    <h2 class="me-3">{{$upload->title}}</h2>

    @if($currentUserSave)
        <form action="{{route('upload.unsave', $upload)}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="stylish-btn">
                Unsave
            </button>
        </form>
    @else
        <form action="{{route('upload.save', $upload)}}" method="post">
            @csrf
            <button type="submit" class="stylish-btn">
                Save
            </button>
        </form>
    @endif
</div>


          <p class="text-muted">Posted by <a href="{{route('users.show', $upload->user)}}">{{$upload->user->name}}</a> on <strong>{{$upload->created_at}}</strong></p>
          <b>Avg. Rating :</b>
          <div class="rate" data-rating="3">
                        @for ($i = 1; $i <= 5; $i++)
                          @if ($i <= round($upload->average_rating)) 
                              <i class="fas fa-star"></i>
                          @else
                              <i class="far fa-star"></i>
                          @endif
                      @endfor
                           
                        </div>
        <br>
          <p><strong>Caption:</strong> {{$upload->caption}}</p>
          @if ($tags && $tags->count() > 0)
                            @foreach ($tags as $tag)
                                
                                    <a href="{{route('tags.search', $tag->tag)}}">#{{$tag->tag}}</a>                                
                               
                            @endforeach
                        @endif
          <p><strong>Link : </strong><a href="{{$upload->link}}">{{$upload->link}}</a></p>
          <p><strong>Category : </strong>
          @if ($upload->category)
        <a href="{{ route('categories.show', $upload->category) }}">{{ $upload->category->catname }}</a>
    @else
        Null
    @endif
          
          


          <p><strong>Saves count : {{$upload->saves}}</strong></p>
          
          @if (!$userReview)
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
                        <button type="submit" class="stylish-btn">Submit Review</button>
                    </form>
                    <br>
                    @endif


          
          @if($upload->reviews > 0)  
          <h4>Comments and Ratings by other users  : 
          ({{$upload->reviews}})  </h4>
          <div class="scrollable-comments border p-2">

@if($sortedReviews->isNotEmpty())
          @foreach($sortedReviews as $review)
          <div class="mb-2">
          <b>{{$review->user->name}}</b> on <div class="text-muted" style="display: inline; margin: 0; padding: 0;" > {{$review->created_at}}
          @auth
              @if($review->user->name===auth()->user()->name)
              
              <form action="{{ route('uploads.reviews.destroy', [$upload->id, $review->id]) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" onclick="confirm('Are you sure?')" class="icon-button"><i class="fa-regular fa-trash-can" style="color: red;"></i></button>
              </form>
              @endif
              @endauth

          </div><br/>
          {{$review->comment}} <br/>                   
          <div class="rate" data-rating="3">
              @for ($i = 1; $i <= 5; $i++)
                @if ($i <= round($review->rating)) 
                    <i class="fas fa-star"></i>
                @else
                    <i class="far fa-star"></i>
                @endif
            @endfor                                                 
              </div>
       
</div>
          @endforeach
          @endif

                @endif
          
            
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
            color: gold; 
        }

        .stars input[type="radio"]:checked ~ label {
            color: gold;
        }

       
        .stars input[type="radio"]:checked + label,
        .stars input[type="radio"]:checked + label ~ label {
            color: gold;
        }
        .icon-button {
    background: none; 
    border: none;    
    padding: 0;      
    cursor: pointer;  
    display: inline;   
}
    </style>
  

@endsection