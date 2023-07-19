<?php

namespace App\Http\Controllers;

use App\Repositories\BookRepository;
use App\Http\Resources\BookResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateBookRequest;
use Throwable;

class BookController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Repositories\BookRepository  $bookRepository
     * @return void
     */
    public function __construct(protected BookRepository $bookRepository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\BookResource|\Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return BookResource::collection($this->bookRepository->getAllBook());
        } catch (Throwable $th) {
            return response()->json(["message" => "error when trying to fetch books"], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\StoreUpdateBookRequest $request
     * @return App\Http\Resources\BookResource|\Illuminate\Http\Response
     */
    public function store(StoreUpdateBookRequest $request)
    {
        try {
            $book = $this->bookRepository->createBook($request);

            return new BookResource($book);
        } catch (Throwable $th) {
            return response()->json(["message" => "error when trying to register the book"], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return App\Http\Resources\BookResource|\Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $book = $this->bookRepository->getBookById($id);
        
            return new BookResource($book);
        } catch (Throwable $th) {
            return response()->json(["message" => "error when trying to fetch the book"], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\StoreUpdateBookRequest $request
     * @param int $id
     * @return App\Http\Resources\BookResource|\Illuminate\Http\Response
     */
    public function update(StoreUpdateBookRequest $request, $id)
    {
        try {
            $book = $this->bookRepository->updateBook($request, $id);

            return new BookResource($book);
        } catch (Throwable $th) {
            return response()->json(["message" => "error when trying to update the book"], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->bookRepository->deleteBook($id);

            return response()->json(["message" => "successfully deleted records"], 200);
        } catch (Throwable $th) {
            return response()->json(["message" => "error when trying to delete book"], 500);
        }
    }
}
