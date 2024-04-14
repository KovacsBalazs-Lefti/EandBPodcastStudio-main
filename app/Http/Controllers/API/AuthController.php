<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request ) {
        $userData = $request->all();
        $userData['jelszo'] = Hash::make($request->input('jelszo'));

        // Felhasználó létrehozása és mentése
        $user = User::create($userData);

        //return $user;
        return response()->json($user, 201);

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
