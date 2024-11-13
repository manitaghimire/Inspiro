@extends('layouts.navigation')
@section('title', 'Categories')
@section('content')

<style>
     a{
        color:black;
    }

 
</style>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<h3><a href="{{route('categories.create')}}" class="stylish-link" style="margin-bottom:10px;">Add new category</a></h3>
<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach($categories as $category)
        <!-- Card 1 -->
        <div class="col">
            <div class="card h-100">
            @if($category->icon)
                        <img src="{{asset('storage/'.$category->icon)}}"  class="card-img-top" alt="Post Image" >
                        @else
                        No icon uploaded
                        @endif

                <div class="card-body">
                  
                        <b class="card-title"><a href="{{route('categories.show',$category)}}">{{$category->catname}}</a></b>                    
           
                        <p class="card-text text-truncate">{{$category->description}}</p>

                    <div class="d-flex justify-content-between">
    <small>Created at : {{$category->created_at}}</small>
    <div class="d-inline-flex">
    <a href="{{route('categories.edit',$category)}}"><i class="fa-regular fa-pen-to-square" style="color: green; margin-right: 6px;"></i></a>
    <form action="{{route('categories.destroy',$category)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" class="icon-button"><i class="fa-regular fa-trash-can" style="color: red;"></i></button>
                            </form>        
        
    </div></div>

                    
                </div>
            </div>
        </div>
  @endforeach
</div>


               
           @endsection