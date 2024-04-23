<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Foglalas;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        //van-e bejelentkezett felhasználó
        // Ellenőrizzük, hogy a bejelentkezett felhasználó rendelkezik-e adminisztrátori jogosultsággal
        if (!Auth::user()->role === 'admin') {
            return response()->json(['error' => 'Nincs jogosultságod ehhez a művelethez'], 403);
        }

        // Lekérjük az összes felhasználót és visszaadjuk JSON formátumban
        $users = User::all();
        return response()->json(['user' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $userData = $request->all();
       $userData['jelszo'] = Hash::make($request->input('jelszo'));

        //Felhasználó létrehozása és mentése
        $user = User::create($userData);

        return $user;
       return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $felhasznaloid)
    {
        $user = User::find($felhasznaloid);
        if (!$user) {
            return response()->json(['error' => 'A felhasználó nem található'], 404);
        }
        if (!Auth::check()) {
            return response()->json(['Nincs bejelentkezett felhasználó'], 401);
        }
        return response()->json([$user, 200]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $felhasznaloid)
    {
        $user = User::find($felhasznaloid);

        if(is_null($user)) {
            return response()->json(["message"=>"Felhasznalo nem található: $felhasznaloid"],404);
        }

        if (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Nincs jogosultságod ehhez a művelethez'], 403);
            //return User::where("user_felhasznaloid", $user->felhasznaloid)->get();
        }
        $user->fill($request->all());
        $user->save();


        return response()->json(['message' => 'A felhasználó sikeresen frissült!', 'felhasznalo' => $user], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $felhasznaloid)

    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Nincs ilyen bejelentkezett felhasználó'], 401);
        }
        if (!Auth::user()->role === 'admin') {
            return response()->json(['error' => 'Nincs jogosultságod ehhez a művelethez'], 403);
        }
        $user = User::find($felhasznaloid);

        if (!$user) {
                return response()->json(['error' => 'A felhasználó nem található'], 404);
        }

        $affected = Foglalas::where('user_felhasznaloid', $user->felhasznaloid)->update(['user_felhasznaloid' => null]);

        if ($user->delete()) {
                return response()->json(['message' => ' A felhasználó sikeresen törlésre került'], 200);
            } else {
                return response()->json(['error' => ' Nem sikerölt a felhasználót törölni'], 500);
        }
    }
}
