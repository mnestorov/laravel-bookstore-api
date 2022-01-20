<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BooksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => (string) $this->id,
            'type' => 'Books',
            'added_by' => \App\Models\User::find($this->added_by)->name,
            'attributes' => [
                'name'  => $this->name,
                'author' => $this->author->implode('name', ', '), // comma separation for multiple authors
                'description' => $this->when($request->book, $this->description), // show the description of the book only on single listing
                'publication_year' => $this->publication_year,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ]
        ];
    }
}
