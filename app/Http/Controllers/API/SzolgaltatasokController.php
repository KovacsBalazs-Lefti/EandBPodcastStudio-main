<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSzolgaltatasokRequest;
use App\Http\Requests\UpdateSzolgaltatasokRequest;
use App\Models\Szolgaltatasok;
use Illuminate\Http\Request;

class SzolgaltatasokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$user= auth()->user();
        //return Szolgaltatasok::where("user_felhasznaloid", $user->szolgaltatasid)->get();
        $szolgaltatasok = Szolgaltatasok::all();
        return $szolgaltatasok;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSzolgaltatasokRequest $request)
    {
        $user = auth()->user();
        $szolgaltatas = new Szolgaltatasok($request->all());
        //userid beállítása az authentikált user id-ra
        $szolgaltatas->user_felhasznaloid = $user->felhasznaloid;
        $szolgaltatas->foglalasid_szolgaltatasok = $user->foglalasid;
        $szolgaltatas->save();
        return $szolgaltatas;

    }

    /**
     * Display the specified resource.
     */
    public function show(string $szolgalatasid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSzolgaltatasokRequest $request, string $szolgalatasid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $szolgalatasid)
    {
        //
    }
}
