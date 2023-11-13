<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;
use App\Models\Book;

class AddFakeBooks extends Command
{
    protected $signature = 'fake:books';
    protected $description = 'Add fake books to the books table';

    public function handle()
    {
       $apiUrl = 'https://fakerapi.it/api/v1/books?_quantity=100';
        $response = Http::get($apiUrl);
        $data = $response->json();

        foreach ($data['data'] as $fakeBook) {
            $book = new Book();
            $book->title = $fakeBook['title'];
            $book->author = $fakeBook['author'];
            $book->genre = $fakeBook['genre'];
            $book->description = $fakeBook['description'];
            $book->publisher = $fakeBook['publisher'];
            $book->isbn = $fakeBook['isbn'];
            $book->published_at = $fakeBook['published'];

            $book->save();
        }

        $this->info('Fake books added successfully!');
    }
}
