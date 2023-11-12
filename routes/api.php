<?php

use App\Http\Controllers\Admin\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('admin')->group(function () {
    Route::get('get_books', [BookController::class, 'getBooks']);
    Route::post('add_book', [BookController::class, 'addBook']);
    Route::patch('edit_book/{id}', [BookController::class, 'editBook']);
    Route::delete('delete_book/{id}', [BookController::class, 'deleteBook']);
});