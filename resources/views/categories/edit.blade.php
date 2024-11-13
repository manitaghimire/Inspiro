@extends('layouts.navigation')
@section('title', 'Edit Category')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5 d-flex justify-content-center">
    <div class="w-50">
        <form action="{{ route('categories.update', $category) }}" method="post" enctype="multipart/form-data" class="p-4 border rounded">
            <h2 class="text-center mb-4 stylish-text">Update Category</h2>
            <p class="text-center text-muted mb-4">
                Modify category details such as name, description, and icon to better organize your content.
            </p>
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="catname" class="form-label"><b>Category Name:</b></label>
                <input type="text" name="catname" id="catname" class="form-control" value="{{ $category->catname }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label"><b>Description:</b></label>
                <textarea name="description" id="description" rows="3" class="form-control">{{ $category->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label"><b>Slug:</b></label>
                <input type="text" name="slug" id="slug" class="form-control" value="{{ $category->slug }}">
            </div>

            <div class="mb-3">
                <label for="icon" class="form-label"><b>Icon:</b></label>
                <div class="mb-3">
                    @if ($category->icon)
                        <img src="{{ asset('storage/' . $category->icon) }}" alt="Icon Preview" class="img-fluid mb-3" id="icon-preview" style="max-height: 100px;">
                    @else
                        <p class="text-muted">No icon uploaded</p>
                        <img id="icon-preview" alt="Icon Preview" class="img-fluid mb-3 d-none" style="max-height: 100px;">
                    @endif
                </div>
                <input type="file" name="icon" id="icon" class="form-control" onchange="previewIcon(event)">
            </div>

            <div class="mt-4">
                <button type="submit" class="stylish-btn w-100">Update Category</button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewIcon(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const preview = document.getElementById('icon-preview');
            preview.src = reader.result;
            preview.classList.remove('d-none');
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection
