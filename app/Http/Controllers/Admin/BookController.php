<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddBookRequest;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function getBooks(Request $request) {
      $book = Book::all();
      return response()->json($book);
    }
    public function addBook(AddBookRequest $request) {
        try {
            $book = new Book();
            $book->title = $request->title;
            $book->author = $request->author;
            $book->genre = $request->genre;
            $book->description = $request->description;
            $book->isbn = $request->isbn;
            $book->published_at = $request->published_at;
            $book->save();

            return response()->json(['message' => 'Book added successfully', 'book' => $book], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server Error'], 500);
        }
    }
    public function editBook(AddBookRequest $request, $id) {
        try {
            $book = Book::findorfail($id);
            $book->title = $request->title;
            $book->author = $request->author;
            $book->genre = $request->genre;
            $book->description = $request->description;
            $book->isbn = $request->isbn;
            $book->published_at = $request->published_at;
            $book->save();

            return response()->json(['message' => 'Book edited successfully', 'book' => $book], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server Error'], 500);
        }
    }
    public function deleteBook($id) {
        try {
            $book = Book::findorfail($id);
            $book->delete();

            return response()->json(['message' => 'Book deleted successfully'], 200);
        }catch (\Exception $e) {
            return response()->json(['error' => 'Server Error'], 500);
        }
    }
}
