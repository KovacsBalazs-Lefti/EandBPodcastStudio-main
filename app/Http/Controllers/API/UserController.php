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


        // Lekérjük az összes felhasználót és visszaadjuk JSON formátumban
        $users = User::all();
        return response()->json(['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        return User::where("user_felhasznaloid", $user->felhasznaloid)->get();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = User::all();
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
