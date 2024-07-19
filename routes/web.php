<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
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

Route::prefix("admin")->middleware("auth")->group(function () {
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

    // user routes
    Route::get("users", [UserController::class, "index"])->name("user.index");
    Route::get("users/create", [UserController::class, "create"])->name("user.create");
    Route::post("users/create", [UserController::class, "store"]);
    Route::get('users/{id}/edit', [UserController::class, "edit"])->name("user.edit");
    Route::post('users/{id}/edit', [UserController::class, "update"]);
    Route::delete('users/delete', [UserController::class, "delete"])->name("user.delete");
});

Route::get("/login", [LoginController::class, "showLogin"])->name("login");
Route::post("/login", [LoginController::class, "login"]);
Route::post("/logout", [LoginController::class, "logout"])->name("logout");

Route::fallback(function () {
    return redirect()->route('login');
});
