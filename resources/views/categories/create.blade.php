@extends('layouts.navigation')
@section('title', 'Categories')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5 d-flex justify-content-center">
    <div class="w-50">
        <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data" class="p-4 border rounded">
            <h2 class="text-center mb-4 h2-style stylish-text">Create a New Category</h2>
            <p class="text-center text-muted mb-4">
                Add a new category to organize your uploads. Provide details and an icon for better identification.
            </p>
            @csrf

            <div class="mb-3">
                <label for="catname" class="form-label"><b>Category Name:</b></label>
                <input type="text" name="catname" id="catname" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label"><b>Description:</b></label>
                <textarea name="description" id="description" rows="3" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label"><b>Slug:</b></label>
                <input type="text" name="slug" id="slug" class="form-control">
            </div>

            <div class="mb-3">
                <label for="icon" class="form-label"><b>Icon:</b></label>
                <input type="file" name="icon" id="icon" class="form-control" onchange="previewImage(event)">
                <img id="image-preview" src="#" alt="Image Preview" class="img-fluid mt-3 d-none" style="max-height: 200px;">
            </div>

            <div class="mt-4">
                <button type="submit" class="stylish-btn w-100">Save Category</button>
            </div>
        </form>
    </div>
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
</script>
@endsection
