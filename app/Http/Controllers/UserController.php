<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->searchText($request->search_text)
            ->paginate(5);
        return view("admin.users.list", compact("users"));
    }

    public function create()
    {
        return view("admin.users.create-update");
    }

    public function store(Request $request)
    {
        $data = $request->except("_token");
        $data['password'] = bcrypt($data['password']);
        User::create($data);

        alert()
            ->success('Basarili', "Kullanici Olusturuldu!")
            ->showConfirmButton('Tamam', '#3085d6')
            ->autoClose(5000);

        return redirect()->route("user.index");
    }

    public function edit(Request $request, int $userID)
    {
        // create ve update tek sayfada oldugu icin burada author'lari gonderip view da isset ile kontrolu yaptim.
        $users = User::query()
            ->where("id", $userID)
            ->first();

        return view("admin.users.create-update", compact('users'));
    }


    public function update(Request $request)
    {
        // validation kontrolu
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        try {
            $user = User::query()
                ->where("id", $request->id)
                ->first();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;

            if (!is_null($user->password)) {
                $user->password = bcrypt($user->password);
            } else {
                unset($user->password);
            }
            // dd($user);

            $user->save();

        } catch (\Exception $exception) {
            abort(404, $exception->getMessage());
        }
        alert()
            ->success('Basarili', "Kullanici Guncellendi!")
            ->showConfirmButton('Tamam', '#3085d6')
            ->autoClose(5000);

        return redirect()->route("user.index");
    }

    public function delete(Request $request): JsonResponse
    {
        $user = User::findOrFail($request->id);
        // $user->articles()->delete();
        $user->delete();

        return response()
            ->json(['status' => "success", "message" => "basarili"])
            ->setStatusCode(200);
    }
}