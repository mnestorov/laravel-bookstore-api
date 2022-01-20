<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'description',
        'publication_year',
        'user_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot',
        'added_by',
    ];

    public function author()
    {
        return $this->hasManyThrough(Author::class, BookAuthor::class, 'book_id', 'id', 'id', 'author_id');
    }

    public function addedByUser()
    {
        return $this->belongsTo(User::class, 'added_by', 'id');
    }
}
