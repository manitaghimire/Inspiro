@extends('layouts.navigation')
@section('title', 'Categories')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5 d-flex justify-content-center">
<div class="w-50">
    
    <form action="{{route('uploads.store')}}" method="post" enctype="multipart/form-data" class="p-4 border rounded">
    <h2 class="text-center mb-4 h2-style stylish-text">Share your idea and inspire others</h2>
    <p class="text-center text-muted mb-4 stylish-text">
        Post your latest ideas, inspirations, and projects. Add details, images, and tags to connect with  like-minded creators and get noticed.
    </p>
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label"><b>Title:</b></label>
            <input type="text" name="title" class="form-control" id="title" required>
        </div>

        <div class="mb-3">
            <label for="caption" class="form-label"><b>Description:</b></label>
            <textarea name="caption" id="caption" rows="3" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="uploadimage" class="form-label"><b>Image:</b></label>
            <input type="file" name="imageurl" id="uploadimage" class="form-control" onchange="previewImage(event)">
            <img id="image-preview" src="#" alt="Image Preview" class="img-fluid mt-3 d-none" style="max-height: 200px;">
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label"><b>Category:</b></label>
            <select name="category_id" id="category_id" class="form-select">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->catname}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="link" class="form-label"><b>Link:</b></label>
            <input type="url" name="link" id="link" class="form-control">
        </div>

        <div class="mb-3" id="tag-container">
            <label class="form-label"><b>Tags:</b></label>
            <input type="text" name="tags[]" class="form-control mb-2" placeholder="Tag">
        </div>
        <button type="button" id="add-tag" class="btn btn-outline-secondary btn-sm">+ Add Tag</button>

        <div class="mt-4">
            <button type="submit" class="stylish-btn w-100">Upload Post</button>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const preview = document.getElementById('image-preview');
            preview.src = reader.result;
            preview.classList.remove('d-none');
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    document.getElementById('add-tag').addEventListener('click', function () {
        const newTagInput = document.createElement('input');
        newTagInput.type = 'text';
        newTagInput.name = 'tags[]';
        newTagInput.className = 'form-control mb-2';
        newTagInput.placeholder = 'Tag';
        document.getElementById('tag-container').appendChild(newTagInput);
    });
</script>
@endsection
