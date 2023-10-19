<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PublisherController;
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


Route::prefix("admin")->group(
    function () {
        Route::get('/', function () {
            return view('home');
        })->name("admin.index");

        // author routes
        Route::get("author", [AuthorController::class, "index"])->name("author.index");
        Route::get("author/create", [AuthorController::class, "create"])->name("author.create");
        Route::post("author/create", [AuthorController::class, "store"]);
        Route::get("author/{id}/edit", [AuthorController::class, "edit"])->name("author.edit");
        Route::post("author/{id}/edit", [AuthorController::class, "update"]);
        Route::delete("author/delete", [AuthorController::class, "delete"])->name("author.delete");

        // book routes
        Route::get("book", [BookController::class, "index"])->name("book.index");
        Route::get("book/create", [BookController::class, "create"])->name("book.create");
        Route::post("book/create", [BookController::class, "store"]);
        Route::get("book/{id}/edit", [BookController::class, "edit"])->name("book.edit");
        Route::post("book/{id}/edit", [BookController::class, "update"]);
        Route::delete("book/delete", [BookController::class, "delete"])->name("book.delete");

        // publisher routes
        Route::get("publisher", [PublisherController::class, "index"])->name("publisher.index");
        Route::get("publisher/create", [PublisherController::class, "create"])->name("publisher.create");
        Route::post("publisher/create", [PublisherController::class, "store"]);
        Route::get("publisher/{id}/edit", [PublisherController::class, "edit"])->name("publisher.edit");
        Route::post("publisher/{id}/edit", [PublisherController::class, "update"]);
        Route::delete("publisher/delete", [PublisherController::class, "delete"])->name("publisher.delete");

    }
);