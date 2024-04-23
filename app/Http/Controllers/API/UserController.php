<?php

namespace App\Http\Controllers\API;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Foglalas;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
    {
        //van-e bejelentkezett felhasználó
        // Ellenőrizzük, hogy a bejelentkezett felhasználó rendelkezik-e adminisztrátori jogosultsággal
        if (!Auth::user()->role==='admin') {
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
        if (!Auth::user()->role === 'admin'){
            return response ()->json(['error'=> 'Nincs jogosultságod ehhez a művelethez'],403);
            //return User::where("user_felhasznaloid", $user->felhasznaloid)->get();
            $user = User::create($request->all());
            return response()->json($user,201);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $felhasznaloid)
    {
        $user = User::find($felhasznaloid);
        if (!$user){
            return response()->json(['error' => 'A felhasználó nem található'], 404);
        }
        if (!Auth::check()) {
            return response()->json(['Nincs bejelentkezett felhasználó'], 401);
        }
        return response()->json([$user,200]);
        if (Auth::user()){
            return response()->json(['error'=>'Nincs jogosultságod ehhez a művelethez'],403);
        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $felhasznaloid)
    {
        if (!Auth::user()->role === 'admin'){
            return response ()->json(['error'=> 'Nincs jogosultságod ehhez a művelethez'],403);
            //return User::where("user_felhasznaloid", $user->felhasznaloid)->get();
            $user = User::find($felhasznaloid);
            if (!$user){
                return response ()->json(['error'=> 'A felhasznalo nem található'],404);
            }
            $user->save();
            return response ()->json(['error'=> 'A felhasználó mentésre került'],200);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $felhasznaloid)

    {
        if(!Auth::check()){
            return response() ->json(['error'=>'Nincs ilyen bejelentkezett felhasználó'], 401);

        }
        if (!Auth::user()->role === 'admin'){
            return response ()->json(['error'=> 'Nincs jogosultságod ehhez a művelethez'],403);

            $user = User::find($felhasznaloid);
            if(!$user){
                return response()->json(['error' => 'A felhasználó nem található'], 404);
            }

            $affected = Foglalas::where('user_felhasznaloid', $user->felhasznaloid)->update(['user_felhasznaloid'=>null]);

            $user->delete();
            return response()->json(['message' => ' A felhasználó sikeresen törlésre került'], 200);
        }
    }
}
