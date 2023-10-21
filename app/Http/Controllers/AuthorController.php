<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // listeleme fonk
    public function index(Request $request)
    {
        $authors = Author::query()
            ->with([
                "books",
                "users"
            ])
            ->name($request->name)
            ->paginate(5);

        return view("admin.author.list", compact("authors"));
    }

    // create view
    public function create(Request $request)
    {
        return view("admin.author.create-update");
    }

    // store fonk
    public function store(Request $request)
    {
        // sadece yazar adi kontrol edildigi icin ozel bir validation yapisi kurmadim.
        $request->validate([
            'name' => 'required',
        ]);

        // try cath ile kaydetme islemi gerceklestirilip onceki sayfaya yonlendirildi
        try {
            $author = new Author;
            $author->user_id = auth()->id();
            $author->name = $request->name;

            $author->save();


        } catch (\Exception $exception) {
            abort(404, $exception->getMessage());
        }

        // alert uyarisi verildi onay ile kapanmazise kendisi
        alert()
            ->success('Basarili', "Yazar Kaydedildi!")
            ->showConfirmButton('Tamam', '#3085d6')
            ->autoClose(3000);
        return redirect()->back();
    }

    // edit fonk
    public function edit(Request $request, int $authorID)
    {
        // create ve update tek sayfada oldugu icin burada author'lari gonderip view da isset ile kontrolu yaptim.
        $authors = Author::query()
            ->where("id", $authorID)
            ->first();

        return view("admin.author.create-update", compact('authors'));
    }

    // update fonk
    public function update(Request $request)
    {
        // validation kontrolu
        $request->validate([
            'name' => 'required',
        ]);

        // update
        try {
            $author = Author::query()
                ->where("id", $request->id)
                ->first();
            $author->user_id = auth()->id();
            $author->name = $request->name;


            $author->save();

        } catch (\Exception $exception) {
            abort(404, $exception->getMessage());
        }

        // alert uyarisi verildi onay ile kapanmazsa kendisi 3sn sonra kendiliginden kapanacak
        alert()
            ->success('Basarili', "Yazar Guncellendi!")
            ->showConfirmButton('Tamam', '#3085d6')
            ->autoClose(3000);

        return redirect()->route('author.index');
    }

    // delete fonk
    public function delete(Request $request): JsonResponse
    {
        // silinecek id yi findorfail ile bulup degiskene atadim daha sonrasinda delete islemi gerceklestirdim
        $author = Author::findOrFail($request->id);
        $author->delete();

        // json response
        return response()
            ->json(
                [
                    'status' => "succes",
                    "message" => "Basarili",
                    "data" => $author,
                ]
            )
            ->setStatusCode(200);
    }
}