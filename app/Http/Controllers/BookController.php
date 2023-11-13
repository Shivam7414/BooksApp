<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Elastic\Elasticsearch;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $params = $this->buildBulkIndexParams($books);
        $this->performBulkIndex($params);

        return response()->json(['message' => 'Books indexed successfully!']);
    }

    public function search(Request $request)
    {
        $query = $request->query;

        $response = Elasticsearch::search([
            'index' => 'books',
            'body' => [
                'query' => [
                    'multi_match' => [
                        'query' => $query,
                        'fields' => ['title^3', 'author^2', 'genre', 'isbn', 'published_at'],
                    ],
                ],
            ],
        ]);

        $booksIds = array_column($response['hits']['hits'], '_id');
        $books = Book::query()->findMany($booksIds);
        return response()->json(['data' => $books]);
    }

    private function buildBulkIndexParams($books)
    {
        $params = [
            'index' => config('database.elasticsearch.index'),
            'body' => [],
        ];

        foreach ($books as $book) {
            $params['body'][] = [
                'index' => [
                    '_id' => $book->id,
                ],
            ];

            $params['body'][] = [
                'title' => $book->title,
                'author' => $book->author,
                'genre' => $book->genre,
                'isbn' => $book->isbn,
                'published_at' => $book->published_at,
            ];
        }

        return $params;
    }

    private function performBulkIndex($params)
    {
        $client = ClientBuilder::create()->build();
        $client->bulk($params);
    }
}
