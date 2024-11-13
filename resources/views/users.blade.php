@extends('layouts.navigation')
@section('title', 'User Profile')
@section('content')
<style>
     a{
        color:black;
    }
</style>
<b>
    <!-- User's name : {{$user->name}}<br>
    User's email : {{$user->email}}<br/>
    Account created date : {{$user->created_at}}<br/>
    Account type : 
    @if($user->is_admin)
        Admin
    @else
        Regular User
    @endif -->
</b>

<h2>Posts Uploaded by {{$user->name}}</h2>

<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach($user->uploads as $upload)
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
                    
                    <div class="tags mb-1">
                    @if($upload->tags->count()>0)
                        @foreach($upload->tags as $tag)
                        <span class="tag"><a href="{{route('tags.search', $tag->tag)}}">{{$tag->tag}}</a></span>
                        @endforeach                        
                        @endif
                       
                    </div>
                    Category : <a href="{{route('categories.show', $upload->category)}}">{{$upload->category->catname}}</a><br/>
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


@endsection