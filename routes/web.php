<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [IndexController::class, "index"])->name("main");

Auth::routes(['verify' => true]);

Route::group(["middleware"=>"verified"], function (){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home/edit', [App\Http\Controllers\EditAccountController::class, 'index'])->name('home.edit');
    Route::post('/home/edit/editName', [App\Http\Controllers\EditAccountController::class, 'editName'])->name('home.edit.name');

    Route::post('/home/authors/add', [App\Http\Controllers\Books\AuthorsController::class, 'store'])->name('authors.add');
    Route::get('/home/authors/delete/{id}', [App\Http\Controllers\Books\AuthorsController::class, 'delete'])->name('authors.delete');
    Route::post('/home/authors/edit/{id}', [App\Http\Controllers\Books\AuthorsController::class, 'edit'])->name('authors.edit');
    Route::get('/home/authors/deleteFromBook/{id}/{book_id}', [App\Http\Controllers\Books\AuthorsController::class, 'deleteFromBook'])->name('authors.delete.book');

    Route::post('/home/books/add', [App\Http\Controllers\Books\BooksController::class, 'store'])->name('books.add');
    Route::get('/home/books/delete/{id}', [App\Http\Controllers\Books\BooksController::class, 'delete'])->name('books.delete');
    Route::post('/home/books/edit/{id}', [App\Http\Controllers\Books\BooksController::class, 'edit'])->name('books.edit');
    Route::post('/home/books/linkWithAuthor', [App\Http\Controllers\Books\BooksController::class, 'linkWithAuthor'])->name('books.link');
});

