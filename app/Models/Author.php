<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = ['name'];

    protected $hidden = [
        'laravel_through_key',
        'created_at',
        'updated_at',
    ];

    public function book()
    {
        return $this->belongsToMany(Book::class, BookAuthor::class, 'author_id');
    }
}
