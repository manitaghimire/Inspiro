@extends('layouts.navigation')
@section('title', 'Upload')
@section('content')

<style>
    a{
        color:black;
    }
    .card-img-top {
    border-radius: 10px;
height: 350px; 
object-fit: cover;
/* object-position: top; */
}
</style>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<h3>My Uploads</h3>


<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach($uploads as $upload)
        <!-- Card 1 -->
        <div class="col">
            <div class="card h-100">
                <img src="{{asset('storage/'.$upload->imageurl)}}" class="card-img-top" alt="Post Image">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="card-title"><a href="{{route('uploads.show',$upload)}}">{{$upload->title}}</a></h5>
                        <a href="{{ route('login') }}" class="heart-icon" title="Login to save" data-tooltip="Save" >
                            <i class="fa-solid fa-heart"></i>
                        </a>
                                           

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
                    Category :
                    @if ($upload->category)
                            <a href="{{ route('categories.show', $upload->category) }}">{{ $upload->category->catname }}</a>
                        @else
                            Null
                        @endif

                
                     
                     
                     <br/>
                    <div class="d-flex justify-content-between">
    <small>Posted on : {{$upload->created_at}}</small>
    <div class="d-inline-flex">
    <a href="{{route('uploads.edit',$upload)}}"><i class="fa-regular fa-pen-to-square" style="color: green; margin-right: 6px;"></i></a>
    <form action="{{route('uploads.destroy',$upload)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" class="icon-button"><i class="fa-regular fa-trash-can" style="color: red;"></i></button>
                            </form>        
        
    </div>
    
</div>
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