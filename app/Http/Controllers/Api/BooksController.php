<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\BooksRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\BooksResource;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with(['author', 'addedByUser'])
            ->latest()
            ->paginate(5);

        return response([
            'books' => BooksResource::collection($books),
            'message' => 'Success!'
        ], 200) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * Note: If we using Faker, then we use Illuminate\Http\Request
     *
     * @param  \App\Http\Requests\BooksRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $faker = \Faker\Factory::create(1);
        $book = Book::create([
            'name' => $faker->name,
            'description' => $faker->sentence,
            'publication_year' => $faker->year
        ]);

        //$data = $request->all();
        //$book = Book::create($data);

        return response([
            'book' => new BooksResource($book),
            'message' => 'The book was created successfully.'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return response([
            'book' => new BooksResource($book),
            'message' => 'Success!'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * Note: If we using Faker, then we use Illuminate\Http\Request
     *
     * @param  \App\Http\Requests\BooksRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $faker = \Faker\Factory::create(1);
        $book->update([
            'name' => $faker->name,
            'description' => $faker->sentence,
            'publication_year' => $faker->year
        ]);

        //$data = $request->all();
        //$book->update($data);

        return response([
            'book' => new BooksResource($book),
            'message' => 'The book was updated successfully.'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);

        $book->delete();

        return response([
            'id' => $book->id,
            'name' => $book->name,
            'message' => 'The book was deleted successfully.'
        ], 200);
    }
}
