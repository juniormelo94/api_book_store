<?php

namespace App\Repositories;

use App\Models\Book;
use App\Interfaces\BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface
{
    /**
     * Store a newly created resource in storage.
     *
     * @param App\Models\Book $model
     * @return void
     */
    public function __construct(protected Book $model)
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function getAllBook()
    {
        return $this->model->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function createBook($request)
    {
        $book = $this->model;

        return tap($book, function ($book) use ($request){
            $book->name = $request->name;
            $book->isbn = $request->isbn;
            $book->value = $request->value;
            $book->save();
        });
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return array
     */
    public function getBookById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return array
     */
    public function updateBook($request, $id)
    {
        $book = $this->model->findOrFail($id);

        return tap($book, function ($book) use ($request){
            $book->name = $request->name;
            $book->isbn = $request->isbn;
            $book->value = $request->value;
            $book->save();
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function deleteBook($id)
    {
        $book = $this->model->findOrFail($id);

        return $book->delete();
    }
}
