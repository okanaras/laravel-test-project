<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    // listeleme fonk
    public function index(Request $request)
    {
        $publishers = Publisher::query()
            ->with([
                "books",
                "users"
            ])
            ->name($request->name)
            ->paginate(5);

        return view("admin.publisher.list", compact("publishers"));
    }

    // create view
    public function create(Request $request)
    {
        return view("admin.publisher.create-update");
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
            $publisher = new Publisher;
            $publisher->user_id = auth()->id();
            $publisher->name = $request->name;

            $publisher->save();

        } catch (\Exception $exception) {
            abort(404, $exception->getMessage());
        }

        // alert uyarisi verildi onay ile kapanmazsa kendisi 3sn sonra kendiliginden kapanacak
        alert()
            ->success('Basarili', "Yayinevi Kaydedildi!")
            ->showConfirmButton('Tamam', '#3085d6')
            ->autoClose(3000);

        return redirect()->back();
    }

    // edit fonk
    public function edit(Request $request, int $publisherID)
    {
        // create ve update tek sayfada oldugu icin burada publisher'lari gonderip view da isset ile kontrolu yaptim.
        $publishers = Publisher::query()
            ->where("id", $publisherID)
            ->first();

        return view("admin.publisher.create-update", compact('publishers'));
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
            $publisher = Publisher::query()
                ->where("id", $request->id)
                ->first();
            $publisher->user_id = auth()->id();
            $publisher->name = $request->name;

            $publisher->save();

        } catch (\Exception $exception) {
            abort(404, $exception->getMessage());
        }

        // alert uyarisi verildi onay ile kapanmazsa kendisi 3sn sonra kendiliginden kapanacak
        alert()
            ->success('Basarili', "Yayinevi Guncellendi!")
            ->showConfirmButton('Tamam', '#3085d6')
            ->autoClose(3000);

        return redirect()->route('publisher.index');
    }

    // delete fonk
    public function delete(Request $request): JsonResponse
    {
        // silinecek id yi findorfail ile bulup degiskene atadim daha sonrasinda delete islemi gerceklestirdim
        $publisher = Publisher::findOrFail($request->id);
        $publisher->delete();

        // json response
        return response()
            ->json(
                [
                    'status' => "succes",
                    "message" => "Basarili",
                    "data" => $publisher,
                ]
            )
            ->setStatusCode(200);
    }
}