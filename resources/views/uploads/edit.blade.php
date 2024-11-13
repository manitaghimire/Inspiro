@extends('layouts.navigation')
@section('title', 'Edit Post')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5 d-flex justify-content-center">
    <div class="w-50">
        <form action="{{route('uploads.update', $upload)}}" method="post" enctype="multipart/form-data" class="p-4 border rounded">
            <h2 class="text-center mb-4 stylish-text">Update Your Post</h2>
            <p class="text-center text-muted mb-4">
                Make changes to your post details, update images, and refine your tags to better reach your audience.
            </p>
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label"><b>Title:</b></label>
                <input type="text" name="title" class="form-control" id="title" value="{{$upload->title}}" required>
            </div>

            <div class="mb-3">
                <label for="caption" class="form-label"><b>Description:</b></label>
                <textarea name="caption" id="caption" rows="3" class="form-control">{{$upload->caption}}</textarea>
            </div>

            <div class="mb-3">
                <label for="uploadimage" class="form-label"><b>Image:</b></label>
                @if ($upload->imageurl)
                    <img src="{{ asset('storage/' . $upload->imageurl) }}" alt="Image Preview" class="img-fluid mb-3" style="max-height: 200px;">
                @else
                    <p class="text-muted">No image uploaded</p>
                @endif
                <input type="file" name="imageurl" id="uploadimage" class="form-control" onchange="previewImage(event)">
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label"><b>Category:</b></label>
                <select name="category_id" id="category_id" class="form-select">
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}" @if($upload->category_id == $category->id) selected @endif>{{$category->catname}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="link" class="form-label"><b>Link:</b></label>
                <input type="url" name="link" id="link" class="form-control" value="{{$upload->link}}">
            </div>

            <div class="mb-3" id="tag-container">
                <label class="form-label"><b>Tags:</b></label>
                @if ($tags && $tags->count() > 0)
                    @foreach ($tags as $tag)
                        <input type="text" name="tags[]" value="{{$tag->tag}}" class="form-control mb-2" placeholder="Tag">
                    @endforeach
                @else
                    <input type="text" name="tags[]" class="form-control mb-2" placeholder="Tag">
                @endif
            </div>
            <button type="button" id="add-tag" class="btn btn-outline-secondary btn-sm">+ Add Tag</button>

            <div class="mt-4">
                <button type="submit" class="stylish-btn w-100">Update Post</button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const preview = document.querySelector('img[alt="Image Preview"]');
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
