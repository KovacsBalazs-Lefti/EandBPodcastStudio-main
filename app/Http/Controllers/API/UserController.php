<?php

namespace App\Http\Controllers\API;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
    {
        //van-e bejelentkezett felhasználó
        if(Auth::check()) {
            return response()->json(['message' =>'Nincs bejelentkezett felhasználó'],401);
        }
        //jogosultság ellenőrzés
        $user = Auth::user();
        if(!$user>isAdmin()){
            return response()->json(['error' => 'Nincs jogosultságod ehhez a művelethez'], 403);
        }
        $users = User::all();
        return response()->json(['users' =>$users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
