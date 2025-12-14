<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookImage;
use App\Http\Requests\StoreBookRequest;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // 1. Бүх номын жагсаалт
    public function index()
    {
        $books = Book::paginate(5); // Pagination
        return view('books.index', compact('books'));
    }

    // 2. Ном нэмэх form
    public function create()
    {
        return view('books.create');
    }

    // 3. Шинэ ном хадгалах (VALIDATION + MULTIPLE IMAGES + FLASH)
    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id(); // Assign logged user

        // 1. Create the book
        $book = Book::create($data);

        // 2. SAVE MULTIPLE IMAGES
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {

                // Save image to /storage/app/public/book_images
                $path = $img->store('book_images', 'public');

                // Create BookImage record
                $book->images()->create([
                    'image_path' => $path
                ]);
            }
        }

        session()->flash('success', 'Book added successfully!');
        return redirect()->route('books.index');
    }

    // 4. Нэг номын дэлгэрэнгүй
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    // 5. Засварлах form
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    // 6. Засварласан мэдээлэл хадгалах (UPDATE + IMAGE REPLACE + FLASH)
    public function update(StoreBookRequest $request, Book $book)
    {
        $data = $request->validated();

        // Update main fields
        $book->update($data);

        // If user uploaded new images → delete old ones first
        if ($request->hasFile('images')) {

            // 1. DELETE OLD IMAGES
            foreach ($book->images as $image) {
                Storage::disk('public')->delete($image->image_path);
                $image->delete();
            }

            // 2. SAVE NEW IMAGES
            foreach ($request->file('images') as $img) {
                $path = $img->store('book_images', 'public');

                $book->images()->create([
                    'image_path' => $path
                ]);
            }
        }

        session()->flash('success', 'Book updated successfully!');
        return redirect()->route('books.index');
    }

    // 7. Устгах
    public function destroy(Book $book)
{
    // 1. Delete all images from storage + database
    foreach ($book->images as $image) {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();
    }

    // 2. Delete the book itself
    $book->delete();

    session()->flash('success', 'Book deleted successfully!');
    return redirect()->route('books.index');
}

}
