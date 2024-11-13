@extends('layouts.navigation')
@section('title', 'Categories')
@section('content')
<style>
     a{
        color:black;
    }
    .card-img-top {
height: 350px; 
}
</style>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach($saved as $save)
        <!-- Card 1 -->
        <div class="col">
            <div class="card h-100">
                <img src="{{asset('storage/'.$save->upload->imageurl)}}" class="card-img-top" alt="Post Image">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="card-title"><a href="{{route('uploads.show',$save->upload)}}">{{$save->upload->title}}</a></h5>
                        
                       
                        
                        <form action="{{route('upload.unsave', $save->upload)}}" method="post" style="display: inline;">
                            @csrf
                           
                                @method('DELETE')
                            
                            <button type="submit" class="heart-icon active" 
                                    data-tooltip="Unsave">
                                <i class="fa-solid fa-heart"></i>
                            </button>
                        </form>
                    


                    

                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <div class="stars" data-rating="3">
                        @for ($i = 1; $i <= 5; $i++)
                          @if ($i <= round($save->upload->average_rating)) 
                              <i class="fas fa-star"></i>
                          @else
                              <i class="far fa-star"></i>
                          @endif
                      @endfor
                           
                        </div>
                        <small>{{$save->upload->reviews}} Reviews</small>
                    </div>
                    <p class="card-text text-truncate">{{$save->upload->caption}}</p>
                    <p class="mb-1"><small>Uploaded by: <strong><a href="{{route('users.show', $save->upload->user)}}">{{$save->upload->user->name}}</a></strong></small></p>
                    <div class="tags mb-1">
                    @if($save->upload->tags->count()>0)
                        @foreach($save->upload->tags as $tag)
                        <span class="tag"><a href="{{route('tags.search', $tag->tag)}}">{{$tag->tag}}</a></span>
                        @endforeach                        
                        @endif
                       
                    </div>
                    Category :
                    @if ($save->upload->category)
                            <a href="{{ route('categories.show', $save->upload->category) }}">{{ $save->upload->category->catname }}</a>
                        @else
                            Null
                        @endif
                     
                     <br/>
                    <small>Posted on : {{$save->upload->created_at}}</small>
                    <br/>
                    <a href="{{route('uploads.show',$save->upload)}}" class="stylish-link">View Post</a>
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
