<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $books = Book::select("id", "name", "isbn", "value")->get();
    
            return response()->json([
                "status" => "ok",
                "data" => $books
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "error when trying to fetch books"
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), Book::rules(), Book::messages());

            if ($validator->fails()) {
                return response()->json([
                    "status" => "error",
                    "message" => $validator->errors()
                ], 400);
            }

            Book::create($request->all());

            return response()->json([
                "status" => "ok",
                "message" => "book record created"
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "error when trying to register the book"
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $book = Book::select("id", "name", "isbn", "value")->find($id);
    
            if (!$book) {
                return response()->json([
                    "status" => "error",
                    "message" => "book not found"
                ], 404);
            }
            
            return response()->json([
                "status" => "ok",
                "data" => $book
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "error when trying to fetch the book"
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), Book::rules(), Book::messages());

            if ($validator->fails()) {
                return response()->json([
                    "status" => "error",
                    "message" => $validator->errors()
                ], 400);
            }

            $book = Book::find($id);
    
            if (!$book) {
                return response()->json([
                    "status" => "error",
                    "message" => "book not found"
                ], 404);
            }

            $book->update($request->all());

            return response()->json([
                "status" => "ok",
                "message" => "records updated successfully"
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "error when trying to update the book"
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $book = Book::find($id);
    
            if (!$book) {
                return response()->json([
                    "status" => "error",
                    "message" => "book not found"
                ], 404);
            }

            $book->delete();

            return response()->json([
                "status" => "ok",
                "message" => "successfully deleted records"
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "error when trying to delete book"
            ], 400);
        }
    }
}
