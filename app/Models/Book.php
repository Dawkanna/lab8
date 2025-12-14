<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'published_date',
        'price',
        'genre',
        'user_id',  // <-- MUST BE INCLUDED!
    ];

    // Relationship: Book belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function images()
{
    return $this->hasMany(BookImage::class);
}

}
