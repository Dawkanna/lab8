@extends('layouts.master')

@section('title', 'Book List')

@section('content')

<div class="card-custom mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">All books</h2>

        {{-- Only admin + editor can see Add Book --}}
        @can('create', App\Models\Book::class)
            <a href="{{ route('books.create') }}" class="btn btn-primary rounded-pill px-4">
                + Add Book
            </a>
        @endcan
    </div>

    <table class="table table-hover table-bordered align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Images</th>
                <th>Title</th>
                <th>Author</th>
                <th>Date</th>
                <th>Price</th>
                <th>Genre</th>
                <th style="width: 180px;">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($books as $book)
            <tr>
                <td>{{ $book->id }}</td>

                {{-- THUMBNAILS COLUMN --}}
                <td>
                    @foreach ($book->images as $image)
                        <img 
                            src="{{ Storage::url($image->image_path) }}" 
                            alt="thumb"
                            style="width:55px; height:55px; object-fit:cover; border-radius:6px; margin-right:4px;">
                    @endforeach
                </td>

                <td class="fw-semibold">{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->published_date }}</td>
                <td>${{ $book->price }}</td>
                <td>{{ $book->genre }}</td>

                <td>
                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm">View</a>

                    @can('update', $book)
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    @endcan

                    @can('delete', $book)
                        <form action="{{ route('books.destroy', $book->id) }}"
                              method="POST" class="d-inline">
                            @csrf 
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-3">
        {{ $books->links() }}
    </div>
</div>

@endsection
