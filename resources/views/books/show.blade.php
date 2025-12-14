@extends('layouts.master')

@section('title', 'Book Details')

@section('content')

<div class="card-custom">

    <h2 class="fw-bold mb-4">Book Details</h2>

    {{-- IMAGE CAROUSEL --}}
    @if ($book->images->count())
    <div id="bookImagesCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($book->images as $key => $image)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img 
                        src="{{ Storage::url($image->image_path) }}" 
                        class="d-block w-100"
                        style="max-height:400px; object-fit:contain;"
                        alt="Book Image">
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#bookImagesCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#bookImagesCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
    @endif


    {{-- BOOK INFO --}}
    <p><strong>Title:</strong> {{ $book->title }}</p>
    <p><strong>Author:</strong> {{ $book->author }}</p>
    <p><strong>Date:</strong> {{ $book->published_date }}</p>
    <p><strong>Price:</strong> ${{ $book->price }}</p>
    <p><strong>Genre:</strong> {{ $book->genre }}</p>

    <a href="{{ route('books.index') }}" class="btn btn-secondary rounded-pill mt-3 px-4">Back</a>

</div>

@endsection
