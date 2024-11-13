@extends('layouts.navigation')
@section('title', 'Category')
@section('content')
<style>
    .image-container {
    text-align: center; 
}

.image-container img {
    display: inline-block;
}

.description-container {
        width: 600px; 
        margin: 0 auto; 
        text-align: center; 
    }

    .description-container b {
        display: block;
        word-wrap: break-word; 
    }

    a{
        color:black;
    }

</style>
<b style="text-align: center; display: block;" class="stylish-text">
    Explore > Categories > {{$category->catname}}</b>
    
<div class="image-container">
    <img src="{{ asset('storage/' . $category->icon) }}" alt="Icon" style="width: 600px; height: 400px; border-radius: 10px;">
</div>

    
    <div class="description-container">
    <b>{{$category->description}}</b>
</div><hr>
    

<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach($category->uploads as $upload)
        <!-- Card 1 -->
        <div class="col">
            <div class="card h-100">
                <img src="{{asset('storage/'.$upload->imageurl)}}" class="card-img-top" alt="Post Image">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="card-title"><a href="{{route('uploads.show',$upload)}}">{{$upload->title}}</a></h5>
                        
                       
                        

                    

                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <div class="stars" data-rating="3">
                        @for ($i = 1; $i <= 5; $i++)
                          @if ($i <= round($upload->average_rating)) 
                              <i class="fas fa-star"></i>
                          @else
                              <i class="far fa-star"></i>
                          @endif
                      @endfor
                           
                        </div>
                        <small>{{$upload->reviews}} Reviews</small>
                    </div>
                    <p class="card-text text-truncate">{{$upload->caption}}</p>
                    <p class="mb-1"><small>Uploaded by: <strong><a href="{{route('users.show', $upload->user)}}">{{$upload->user->name}}</a></strong></small></p>
                    <div class="tags mb-1">
                    @if($upload->tags->count()>0)
                        @foreach($upload->tags as $tag)
                        <span class="tag"><a href="{{route('tags.search', $tag->tag)}}">{{$tag->tag}}</a></span>
                        @endforeach                        
                        @endif
                       
                    </div>
                    
                    <small>Posted on : {{$upload->created_at}}</small>
                    <br/>
                    <a href="{{route('uploads.show',$upload)}}" class="stylish-link">View Post</a>
                </div>
            </div>
        </div>
  @endforeach
  </div>   
            

<script>
    function toggleHeart(heart) {
        heart.classList.toggle('active');
    }
</script>
<br/>


@endsection