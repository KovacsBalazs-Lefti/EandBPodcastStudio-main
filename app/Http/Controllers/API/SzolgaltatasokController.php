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
        $szolgaltatasok = new Szolgaltatasok($request->all());
        $szolgaltatasok->save();

        return response()->json(["message" => "A szolgáltatás sikeresen létrehozva"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $szolgaltatasid)
    {
        $szolgaltatas = Szolgaltatasok::findOrFail($szolgaltatasid);
        return response()->json($szolgaltatas);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSzolgaltatasokRequest $request, string $szolgaltatasid)
    {
        $szolgaltatas = Szolgaltatasok::findOrFail($szolgaltatasid);
        $szolgaltatas->update($request->all());
        return response()->json(["message" => "A szolgáltatás sikeresen frissítésre került"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $szolgaltatasid)
    {
        $szolgaltatas = Szolgaltatasok::findOrFail($szolgaltatasid);
        $szolgaltatas->delete();
        return response()->json(["message" => "A szolgáltatás sikeresen törlésre került"], 200);
    }
    public function all() {
        return Szolgaltatasok::all();
    }
}
