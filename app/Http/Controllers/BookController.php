<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function search(Request $request){
        try{
            $books = Book::search($request->q)
            ->get();
            $response = $books->map(function ($book) {
                return [
                    'id'    => $book->id,
                    'title' => $book->title,
                ];
            });
            
            return response()->json($response, 200);
        }catch(\Exception $e){
            return response()->json("No books found", 404);
        }
    }

    public function detail($id){
        try{
            $book = Book::findorfail($id);
            return response()->json($book, 200);
        }catch(\Exception $e){
            return response()->json("No book found", 404);
        }
    }
}
