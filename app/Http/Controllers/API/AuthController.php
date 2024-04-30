<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use OpenApi\Annotations as OA;


class AuthController extends Controller
{
    /**
 * @OA\Post(
 *     path="/api/register",
 *     tags={"user"},
 *     summary="Felhasználó regisztrálása",
 *     description="Új felhasználó regisztrálása a rendszerbe.",
 *     operationId="registerUser",
 *     @OA\Response(response=400, description="Érvénytelen felhasználó adatok"),
 *     @OA\Response(response=422, description="Érvénytelen regisztrációs adatok"),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Regisztrációs adatok",
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




    public function register(RegisterRequest $request ) {

        $userData = $request->all();
        $userData['jelszo'] = Hash::make($request->input('jelszo'));

        $userData['role'] = $request->input('role','user');

        // Felhasználó létrehozása és mentése
        $user = User::create($userData);

        //return $user;
        return response()->json($user, 201);

    }

    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Auth"},
     *     operationId="login",
     *     summary="Login",
     *     description="Bejelentkezés a rendszerbe",
     *     @OA\RequestBody(
     *         description="Bejelentkezési adatok",
     *         required=true,
     *         @OA\JsonContent(
     *         type="object",
     *         @OA\Examples(
     *         example="Kovacs",
     *         summary="Kovács Balázs",
     *         value={"email": "kovibali@gmail.com", "jelszo": "kovibali"},
     *          ),
     *          @OA\Examples(example="Teszt Elek",
     *         value={"email": "tesztelek@tesztelek.hu", "jelszo": "tesztelek"},
     *         summary="Kovács Balázs"
     *          )
     *       )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Érvénytelen felhasználói név vagy jelszó"
     *     )
     * )
     */
    public function addPet()
    {
    }
    public function login(LoginRequest $request)  {
        $user = User::where("email", $request->email)->first();

        if (!$user || !Hash::check($request->jelszo, $user->jelszo)) {
            return response()->json(["message" => "Hibás felhasználói név, vagy jelszó"], 401);
        }

        //felhasználókövetés
        $token = $user->createToken("AuthToken")->plainTextToken;

        //401 (nincs authentikálva a felhasználó)
        return response()->json(["token" => $token]);

    }


    public function logout(Request $request) {
        //hitelesített felhasználó lekérdezése
        //$user= $request->user();
        //$user= Auth::user();
        $user = auth()->user();
        //kijelentkezéshez töröljük az aktuális használt tokent

        /**@disregard P1013 Undefined method */
        $user->currentAccessToken()->delete();
        //$currentToken = $user->currentAccessToken();
        //mindenhonnan kijelentkeztetés (listában visszaadja az össes tokent)

         //$allTokens = $user->tokens;
        //return $allTokens;

        return response()->noContent();
    }

    public function logoutEverywhere() {
        $user = auth()->user();
        /**@disregard P1013 Undefined method */
        $user->tokens()->delete();
        return response()->noContent();
    }
}
