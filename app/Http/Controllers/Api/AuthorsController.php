<?php

namespace App\Http\Controllers\Api;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorsRequest;
use App\Http\Resources\AuthorsResource;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::with(['book'])
            ->latest()
            ->paginate(5);

        return response([
            'authors' => AuthorsResource::collection($authors),
            'message' => 'Success!'
        ], 200) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * Note: If we using Faker, then we use Illuminate\Http\Request
     *
     * @param  \App\Http\Requests\AuthorsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $faker = \Faker\Factory::create(1);
        $author = Author::create([
            'name' => $faker->name,
        ]);

        //$data = $request->all();
        //$author = Author::create($data);

        return response([
            'author' => new AuthorsResource($author),
            'message' => 'The author was created successfully.'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        return response([
            'author' => new AuthorsResource($author),
            'message' => 'Success!'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * Note: If we using Faker, then we use Illuminate\Http\Request
     *
     * @param  \App\Http\Requests\AuthorsRequest  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $faker = \Faker\Factory::create(1);
        $author->update([
            'name' => $faker->name,
        ]);

        //$data = $request->all();
        //$author->update($data);

        return response([
            'author' => new AuthorsResource($author),
            'message' => 'The author was updated successfully.'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return response([
            'id' => $author->id,
            'name' => $author->name,
            'message' => 'The author was deleted successfully.'
        ]);
    }
}
