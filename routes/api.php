<?php

use App\Http\Controllers\BookController as UserBookController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
Route::get('/user', function (Request $request) {
    return Auth::guard('admin')->user();
});
Route::get('unauthorized_message', function () {
    return response()->json(['message' => 'Unauthorized'], 401);
})->name('unauthorized.message');

Route::post('admin/login', [AuthController::class, 'login']);
Route::post('admin/logout', [AuthController::class, 'logout']);

Route::get('book/search', [UserBookController::class, 'search']);
Route::get('book/detail/{id}', [UserBookController::class, 'detail']);

//Auth system not working properly

// Route::middleware('auth:admin')->prefix('admin')->group(function () {
//     Route::get('get_books', [BookController::class, 'getBooks']);
//     Route::post('add_book', [BookController::class, 'addBook']);
//     Route::patch('edit_book/{id}', [BookController::class, 'editBook']);
//     Route::delete('delete_book/{id}', [BookController::class, 'deleteBook']);
// });

Route::prefix('admin')->group(function () {
    Route::get('get_books', [BookController::class, 'getBooks']);
    Route::post('add_book', [BookController::class, 'addBook']);
    Route::patch('edit_book/{id}', [BookController::class, 'editBook']);
    Route::delete('delete_book/{id}', [BookController::class, 'deleteBook']);
});