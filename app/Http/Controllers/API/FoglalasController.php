<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFoglalasRequest;
use App\Http\Requests\UpdateFoglalasRequest;
use Illuminate\Http\Request;
use App\Models\Foglalas;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use OpenApi\Annotations as OA;


class FoglalasController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
/**
 * @OA\Get(
 *     path="/api/foglalas",
 *     summary="Foglalások listázása",
 *     tags={"Foglalás"},
 *     description="Bejelentkezett felhasználó foglalásainak listázása",
 *     security={{ "sanctum": {} }},
 *     @OA\Response(
 *         response=200,
 *         description="Sikeres művelet",
 *         @OA\Schema(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Foglalás")
 *         ),
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Nincs bejelentkezve a felhasználó vagy érvénytelen token",
 *     ),
 * )
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

    /**
 * @OA\Post(
 *     path="/api/foglalas",
 *     tags={"foglalas"},
 *     summary="Foglalás létrehozása",
 *     description="Új foglalás létrehozása a rendszerben.",
 *     operationId="createFoglalas",
 *     security={{ "sanctum": {} }},
 *     @OA\Response(response=201, description="Sikeres foglalás létrehozása"),
 *     @OA\Response(response=400, description="Érvénytelen foglalási adatok"),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Foglalási adatok",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 type="object",
 *                 @OA\Property(property="szolgaltatasnev", type="string"),
 *                 @OA\Property(property="letszam", type="integer"),
 *                 @OA\Property(property="foglalaskezdete", type="string", format="date-time"),
 *                 @OA\Property(property="foglalashossza", type="integer"),
 *                 @OA\Property(property="megjegyzes", type="string"),
 *                 example={
 *                     "szolgaltatasnev": "Basic Csomag Plusz",
 *                     "letszam": 2,
 *                     "foglalaskezdete": "2024-07-12 11:00:00",
 *                     "foglalashossza": 4,
 *                     "megjegyzes": "Két kamera, mikrofon, fények, live stream."
 *                 }
 *             )
 *         )
 *     )
 * )
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
        $foglalas = Foglalas::whereNull('deleted_at')->get();
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

    /**
 * @OA\Patch(
 *     path="/api/foglalas/{foglalasid}",
 *     tags={"foglalas"},
 *     summary="Foglalás frissítése",
 *     description="Ez csak bejelentkezett felhasználó által tehető meg.",
 *     operationId="updateFoglalas",
 *     security={{ "sanctum": {} }},
 *     @OA\Parameter(
 *         name="foglalasid",
 *         in="path",
 *         description="Frissítendő foglalás azonosítója",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Response(response=400, description="Érvénytelen foglalás adatok"),
 *     @OA\Response(response=404, description="Foglalás nem található"),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Frissített foglalás objektum",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 type="object",
 *                 example={
 *                     "szolgaltatasnev": "Basic Csomag Plusz",
 *                     "letszam": 2,
 *                     "foglalaskezdete": "2024-06-21 19:00:00",
 *                     "foglalashossza": 1,
 *                     "megjegyzes": "Két kamera, mikrofon, fények."
 *                 }
 *             )
 *         )
 *     ),
 * )
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
    /**
 * @OA\Delete(
 *     path="/api/foglalas/{foglalasid}",
 *     tags={"foglalas"},
 *     summary="Foglalás törlése",
 *     description="Ez csak bejelentkezett felhasználó által tehető meg.",
 *     operationId="deleteFoglalas",
 *     security={{ "sanctum": {} }},
 *     @OA\Parameter(
 *         name="foglalasid",
 *         in="path",
 *         description="Törlendő foglalás azonosítója",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Response(response=400, description="Érvénytelen foglalás azonosító"),
 *     @OA\Response(response=404, description="Foglalás nem található"),
 *     @OA\Response(response=204, description="Sikeres törlés"),
 * )
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
       //$this->authorize("Delete", $foglalas);
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
