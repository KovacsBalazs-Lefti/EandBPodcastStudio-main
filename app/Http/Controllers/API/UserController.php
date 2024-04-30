<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Foglalas;
use Illuminate\Support\Facades\Hash;
use OpenApi\Annotations as OA;


/**
 * @OA\Info(
 *     title="User API",
 *     version="0.1"
 * )
 */



class UserController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/user",
     *     summary="Bejelentkezett felhasznalok listazasa",
     *     tags={"User"},
     *     description="Bejelentkezett felhasznalok listazasa",
     *     security={{ "sanctum": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="sikeres művelet",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/User")
     *         ),
     *     ),
     *      @OA\Response(
     *         response=401,
     *         description="Nincs bejelentkezve a felhasználó vagy érvénytelen token",
     *   ),
     * )
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
 * @OA\Patch(
 *     path="/user/{felhasznaloid}",
 *     tags={"user"},
 *     summary="Felhasználó frissítése",
 *     description="Ez csak bejelentkezett felhasználó által tehető meg.",
 *     operationId="updateUser",
 *     security={{ "sanctum": {} }},
 *     @OA\Parameter(
 *         name="felhasznaloid",
 *         in="path",
 *         description="Frissítendő felhasználó azonosítója",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Response(response=400, description="Érvénytelen felhasználó adatok"),
 *     @OA\Response(response=404, description="Felhasználó nem található"),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Frissített felhasználó objektum",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 type="object",
 *                 example={
 *                     "nev": "Kovács Balázs",
 *                     "email": "kovibali@gmail.com",
 *                     "jelszo": "kovibali",
 *                     "jelszo_megerositese": "securepassword",
 *                     "role": "admin",
 *                     "telefonszam": "123456789",
 *                     "szemelyi_szam": "12345678",
 *                     "szuletesi_datum": "1990-01-01",
 *                     "ceg": true,
 *                     "cegnev": "Acme Inc.",
 *                     "ceg_tipus": "Kft.",
 *                     "ado_szam": "123456789",
 *                     "bankszamlaszam": "12345678901234567890123456",
 *                     "orszag": "Magyarország",
 *                     "iranyitoszam": "1234",
 *                     "varos": "Budapest",
 *                     "utca": "Kossuth utca",
 *                     "utca_jellege": "utca",
 *                     "hazszam": "10",
 *                     "epulet": "A",
 *                     "lepcsohaz": "1",
 *                     "emelet": "2",
 *                     "ajto": "3"
 *                 }
 *             )
 *         )
 *     ),
 * )
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

/**
 * @OA\Delete(
 *     path="/api/user/{felhasznaloid}",
 *     tags={"user"},
 *     summary="Felhasználó törlése",
 *     description="Ez csak bejelentkezett felhasználó által tehető meg.",
 *     operationId="deleteUser",
 *     security={{ "sanctum": {} }},
 *     @OA\Parameter(
 *         name="felhasznaloid",
 *         in="path",
 *         description="Törlendő felhasználó azonosítója",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Response(response=400, description="Érvénytelen felhasználó azonosító"),
 *     @OA\Response(response=404, description="Felhasználó nem található"),
 *     @OA\Response(response=204, description="Sikeres törlés"),
 * )
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
