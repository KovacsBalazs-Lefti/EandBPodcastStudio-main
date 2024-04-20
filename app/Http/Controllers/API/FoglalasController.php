<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFoglalasRequest;
use App\Http\Requests\UpdateFoglalasRequest;
use Illuminate\Http\Request;
use App\Models\Foglalas;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FoglalasController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //felhasználó lekérdezése
        $user = auth()->user();
        //return Foglalas::all();
        //return $user->foglalas;
        //csak a törölt foglalás visszaadása
        //return Foglalas::onlyTrashed()->where("user_felhasznaloid",$user->felhasznaloid)->get();
        //return Foglalas::withTrashed()->where(["user_felhasznaloid" => $user->felhasznaloid, ["deleted_at", "<>", null]])->get();
        //return $user->foglalas;
        return Foglalas::where("user_felhasznaloid", $user->felhasznaloid)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFoglalasRequest $request)
    {
        $user = auth()->user();
        // $foglalas = new Foglalas([
        //     'felhasznaloid'=>$user->felhasznaloid,
        //     'szolgaltatas'=>$request->input('szolgaltatas'),
        //     'letszam'=>$request->input('letszam'),
        //     'foglalaskezdete'=>$request->input('foglalaskezdete'),
        //     'foglalashossza'=>$request->input('foglalashossza'),
        //     'megjegyzes'=>$request->input('megjegyzes'),
        // ]);
        $foglalas = new Foglalas($request->all());
        $foglalas->user_felhasznaloid = $user->felhasznaloid;
        $foglalas->save();
        //user adatok lekérdezése pl email megmutatas-frontenden
        //$foglalas->user;

        return $foglalas;

            // return response()->json([
            //     'message' => ' A foglalás sikeresen létrejött!',
            //     'foglalas' =>$foglalas
            // ], 201);



        // user adatok lekérdezése, például email megjelenítése a frontend-en
        // $foglalas->user;

        return $foglalas;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $felhasznaloid)
    {
        //egy rekord lekérdezése
        $foglalas = Foglalas::find($felhasznaloid);
        //ellenőrzés végrehajtasa, ha nincs - akkor hibaüzenet
        if(is_null($foglalas)){
            return response()->json(["message" => "Foglalás nem található: $felhasznaloid"], 404);
        }
        $this->authorize("View", $foglalas);
        return $foglalas;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoglalasRequest $request, string $user_felhasznaloid)
    {
        //egy rekord lekérdezése
        $foglalas = Foglalas::find($user_felhasznaloid);
        //ellenőrzés végrehajtasa, ha nincs - akkor hibaüzenet
        if(is_null($foglalas)){
            return response()->json(["message" => "Foglalás nem található: $user_felhasznaloid"], 404);
        }
        $this->authorize("update", $foglalas);
        $foglalas->fill($request->all());
        $foglalas->save();
        return response()->json([
            'message' => ' A foglalás sikeresen frissült!',
            'foglalas' =>$foglalas
        ], 201);
        return $foglalas;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $foglalasid)
    {
        $user = auth()->user();
        //egy rekord lekérdezése
       $foglalas = Foglalas::find($foglalasid);
       //ellenőrzés végrehajtasa, ha nincs - akkor hibaüzenet
       if(is_null($foglalas)){
           return response()->json(["message" => "Foglalás nem található: $foglalasid"], 404);
       }
       $this->authorize("Delete", $foglalas);
       $foglalas->delete();
       return response()->noContent();

   //}
    //public function all(){
        //$foglalas = Foglalas::with('user')->get();
       // return $foglalas;
    }
    Public function showWithUser(string $felhasznaloid){
            //egy rekord lekérdezése
            $foglalas = Foglalas::with("user")->find($felhasznaloid);
            //ellenőrzés végrehajtasa, ha nincs - akkor hibaüzenet
            if(is_null($foglalas)){
                return response()->json(["message" => "Foglalás nem található: $felhasznaloid"], 404);
            }
            return $foglalas;
    }
}
