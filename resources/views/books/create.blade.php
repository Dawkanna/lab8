@extends('layouts.master')

@section('title', 'Add Book')

@section('content')

<div class="card-custom">

    <h2 class="fw-bold mb-4">Add New Book</h2>

    {{-- ENCTYPE ADDED --}}
    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- TITLE --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Title</label>
            <input 
                type="text" 
                name="title"
                value="{{ old('title') }}"
                class="form-control rounded-pill @error('title') is-invalid @enderror"
            >
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- AUTHOR --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Author</label>
            <input 
                type="text" 
                name="author"
                value="{{ old('author') }}"
                class="form-control rounded-pill @error('author') is-invalid @enderror"
            >
            @error('author')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- PUBLISHED DATE --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Published Date</label>
            <input 
                type="date" 
                name="published_date"
                value="{{ old('published_date') }}"
                class="form-control rounded-pill @error('published_date') is-invalid @enderror"
            >
            @error('published_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- PRICE --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Price</label>
            <input 
                type="number" 
                step="0.01"
                name="price"
                value="{{ old('price') }}"
                class="form-control rounded-pill @error('price') is-invalid @enderror"
            >
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- GENRE --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Genre</label>
            <input 
                type="text" 
                name="genre"
                value="{{ old('genre') }}"
                class="form-control rounded-pill @error('genre') is-invalid @enderror"
            >
            @error('genre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- BOOK IMAGES --}}
        <div class="mb-3">
            <label for="images" class="form-label fw-bold">Book Images</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple>

            @error('images.*')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- SUBMIT --}}
        <button class="btn btn-success rounded-pill px-4">Save Book</button>

    </form>

</div>

@endsection
