<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{

    // listeleme fonk
    public function index(Request $request)
    {
        $books = Book::query()
            ->with([
                "authors",
                "publishers",
                "users"
            ])
            ->name($request->title)
            ->paginate(5);

        // dd($books);
        return view("admin.book.list", compact("books"));
    }

    // create view
    public function create(Request $request)
    {
        $authors = Author::all();
        $publishers = Publisher::all();

        return view("admin.book.create-update", compact("authors", "publishers"));
    }

    // store fonk
    public function store(Request $request)
    {
        // validation.
        $request->validate([
            'title' => 'required',
            'author_id' => 'required',
            'publisher_id' => 'required',
        ]);

        // try cath ile kaydetme islemi gerceklestirilip onceki sayfaya yonlendirildi
        try {
            $book = new Book;
            $book->user_id = auth()->id();
            $book->title = $request->title;
            $book->author_id = $request->author_id;
            $book->publisher_id = $request->publisher_id;


            dd($book);

            $book->save();

        } catch (\Exception $exception) {
            abort(404, $exception->getMessage());
        }

        // alert uyarisi verildi onay ile kapanmazsa kendisi 3sn sonra kendiliginden kapanacak
        alert()
            ->success('Basarili', "Kitap Kaydedildi!")
            ->showConfirmButton('Tamam', '#3085d6')
            ->autoClose(3000);


        return redirect()->back();
    }

    // edit fonk
    public function edit(Request $request, int $bookID)
    {
        $authors = Author::all();
        $publishers = Publisher::all();

        // dd($authors);

        // create ve update tek sayfada oldugu icin burada book'lari gonderip view da isset ile kontrolu yaptim.
        $books = Book::query()
            ->where("id", $bookID)
            ->first();

        return view("admin.book.create-update", compact('books', 'authors', 'publishers'));
    }

    // update fonk
    public function update(Request $request)
    {
        // validation kontrolu
        $request->validate([
            'title' => 'required',
            'author_id' => 'required',
            'publisher_id' => 'required',
        ]);

        // update
        try {
            $book = Book::find($request->id);

            $book->user_id = auth()->id();
            $book->title = $request->title;
            $book->author_id = $request->author_id;
            $book->publisher_id = $request->publisher_id;


            $book->save();


        } catch (\Exception $exception) {
            abort(404, $exception->getMessage());
        }

        // alert uyarisi verildi onay ile kapanmazsa kendisi 3sn sonra kendiliginden kapanacak
        alert()
            ->success('Basarili', "Kitap Guncellendi!")
            ->showConfirmButton('Tamam', '#3085d6')
            ->autoClose(3000);

        return redirect()->route('book.index');
    }

    // delete fonk
    public function delete(Request $request): JsonResponse
    {
        // silinecek id yi findorfail ile bulup degiskene atadim daha sonrasinda delete islemi gerceklestirdim
        $book = Book::findOrFail($request->id);
        $book->delete();

        // json response
        return response()
            ->json(
                [
                    'status' => "succes",
                    "message" => "Basarili",
                    "data" => $book
                ]
            )
            ->setStatusCode(200);
    }
}