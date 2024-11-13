

@extends('layouts.navigation')
@section('title', 'Search with tags')
@section('content')
<h2>Search items for the tag : {{$tag->tag}}</h2>
<style>
    a{
        color:black;
    }
</style>
<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach($uploads as $upload)
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
                    <a href="{{route('categories.show', $upload->category)}}">{{$upload->category->catname}}</a>
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



@endsection