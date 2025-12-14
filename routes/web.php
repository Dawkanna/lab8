<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard — requires login + email verification
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// ===============================
//   BOOK ROUTES (LARAVEL 12)
// ===============================

// Public: anyone can see book list
Route::get('books', [BookController::class, 'index'])->name('books.index');

// Protected CRUD Routes (must be logged in)
Route::middleware(['auth'])->group(function () {

    // CREATE
    Route::get('books/create', [BookController::class, 'create'])
        ->middleware('can:create,App\Models\Book')
        ->name('books.create');

    Route::post('books', [BookController::class, 'store'])
        ->middleware('can:create,App\Models\Book')
        ->name('books.store');

    // SHOW (optional, you may allow guests or protect it)
    Route::get('books/{book}', [BookController::class, 'show'])
        ->name('books.show');

    // UPDATE
    Route::get('books/{book}/edit', [BookController::class, 'edit'])
        ->middleware('can:update,book')
        ->name('books.edit');

    Route::put('books/{book}', [BookController::class, 'update'])
        ->middleware('can:update,book')
        ->name('books.update');

    // DELETE
    Route::delete('books/{book}', [BookController::class, 'destroy'])
        ->middleware('can:delete,book')
        ->name('books.destroy');
});


// ===============================
//   PROFILE ROUTES (DEFAULT)
// ===============================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
