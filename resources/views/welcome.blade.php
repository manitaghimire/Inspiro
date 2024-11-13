@php
use Illuminate\Support\Str;
@endphp
@extends('layouts.navigation')
@section('title', 'Homepage')
@section('content')

<style>
    a{
        color:black;
    }
</style>

    <h3>Explore the best of Inspiro</h3>
    <hr>
    <br>
    <div class="row">
    @foreach($mostSaved as $upload)
  <div class="col-md-4">
  <a href="{{route('uploads.show',$upload)}}">
    <div class="card text-bg-dark" style="padding: 0px;">
      <img src="{{asset('storage/'.$upload->imageurl)}}" class="card-img" alt="...">
      <div class="card-img-overlay" > 
        <h3 class="card-title">{{$upload->title}}</h3>
        <p class="card-text">{{ Str::limit($upload->caption, 100) }}</p>
      </div>
    </div>
</a>
  </div>
  @endforeach

</div>
<hr>
<!-- second section start --><br/>
<h2>Most Popular Ideas of Inspiro</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach($mostReviewed as $upload)
        <!-- Card 1 -->
        <div class="col">
            <div class="card h-100">
                <img src="{{asset('storage/'.$upload->imageurl)}}" class="card-img-top" alt="Post Image">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="card-title"><a href="{{route('uploads.show',$upload)}}">{{$upload->title}}</a></h5>
                        
                       
                        @auth
                        <form action="{{ count($upload->saveCollection) > 0 ? route('upload.unsave', $upload) : route('upload.save', $upload) }}" method="post" style="display: inline;">
                            @csrf
                            @if(count($upload->saveCollection) > 0)
                                @method('DELETE')
                            @endif
                            <button type="submit" class="heart-icon {{ count($upload->saveCollection) > 0 ? 'active' : '' }}" 
                                    data-tooltip="{{ count($upload->saveCollection) > 0 ? 'Unsave' : 'Save' }}">
                                <i class="fa-solid fa-heart"></i>
                            </button>
                        </form>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}" class="heart-icon" title="Login to save" data-tooltip="Save" >
                            <i class="fa-solid fa-heart"></i>
                        </a>
                    @endguest


                    

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
                    Category : 
                    
                    @if ($upload->category)
                            <a href="{{ route('categories.show', $upload->category) }}">{{ $upload->category->catname }}</a>
                        @else
                            Null
                        @endif
                    
                    <br/>
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
<!-- third section starts -->
<h2>Browse By Category</h2>
               
                @foreach($categories as $category)
                <br/>
                <div class="d-flex justify-content-between"><h4>{{$category->catname}}</h4><a href="{{route('categories.show',$category)}}"> View all>>></a></div><hr/>
                
                <div class="row row-cols-1 row-cols-md-3 g-4">

                @foreach($category->uploads as $upload)
                <div class="col">
            <div class="card h-100">
                <img src="{{asset('storage/'.$upload->imageurl)}}" class="card-img-top" alt="Post Image">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="card-title"><a href="{{route('uploads.show',$upload)}}">{{$upload->title}}</a></h5>

                        @auth
                        <form action="{{ count($upload->saveCollection) > 0 ? route('upload.unsave', $upload) : route('upload.save', $upload) }}" method="post" style="display: inline;">
                            @csrf
                            @if(count($upload->saveCollection) > 0)
                                @method('DELETE')
                            @endif
                            <button type="submit" class="heart-icon {{ count($upload->saveCollection) > 0 ? 'active' : '' }}" 
                                    data-tooltip="{{ count($upload->saveCollection) > 0 ? 'Unsave' : 'Save' }}">
                                <i class="fa-solid fa-heart"></i>
                            </button>
                        </form>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}" class="heart-icon" title="Login to save" data-tooltip="Save" >
                            <i class="fa-solid fa-heart"></i>
                        </a>
                    @endguest

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
                   
                    <small>Posted on : {{$upload->created_at}}</small><br/>
                    
                    @if ($upload->saves == 1)
                    <small>Saved By : {{$upload->saves}} people</small>
                    <br/>
                    @endif
                    <a href="{{route('uploads.show',$upload)}}" class="stylish-link">View Post</a>
                </div>
            </div>
        </div>
        @endforeach
        <br>
  </div>
  @endforeach 
  <br/>               
@endsection
