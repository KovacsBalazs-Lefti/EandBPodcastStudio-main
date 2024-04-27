<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "nev" => "required|string",
            "email" => "required|email|unique:users,email",
            "jelszo" => "required|string|min:8",
            "telefonszam" => "required|string",
            "szemelyi_szam" => "required|string|min:8",
            "szuletesi_datum" => "required|date_format:Y-m-d|before:-18 years",
            "ceg" => "nullable|boolean",
            "cegnev" => "nullable|required_if:ceg,true|string",
            "ceg_tipus" => "nullable|required_if:ceg,true|string",
            "ado_szam" => "nullable|required_if:ceg,true|string",
            "bankszamlaszam" => "nullable|required_if:ceg,true|string",
            "orszag" => "required|string",
            "iranyitoszam" => "required|string",
            "varos" => "required|string",
            "utca" => "required|string",
            "utca_jellege" => "required|string",
            "hazszam" => "required|string",
            "epulet" => "nullable|string",
            "lepcsohaz" => "nullable|string",
            "emelet" => "nullable|string",
            "ajto" => "nullable|string",


        ];
    }
    public function messages(): array
    {
        return[
            "nev.required" => "A név mező kitöltése kötelező",
            "email.required" => "Az emailcím kötöltése kötelező",
            "email.email" => "A név mező kitöltése kötelező",
            "email.unique" => "Ez az emailcím már foglalt",
            "jelszo.required" => "A jelszó mező kitöltése kötelező",
            "jelszo.min" => "A jelszónak legalább 8 karakternek kell lennie",
            "telefonszam.required" => "A telefonszám mező kitöltése kötelező",
            "szemelyi_szam.required" => "A személyi szám mező kitöltése kötelező",
            "szemelyi_szam.min" => "A személyi szám mezőnek legalább 8 karakternek kell lennie",
            "szuletesi_datum.required" => "A születési dátum mező kitöltése kötelező",
            "szuletesi_datum.date_format" => "A születési dátum formátuma nem megfelelő. (Pl.: YYYY-MM--DD)",
            "szuletesi_datum.before" => "A felhasználónak legalább 18 évesnek kell lennie",
            "cegnev" =>"A cégnév mező kitöltése kötelező,ha a Cég mező ki van jelölve",
            "ceg_tipus" => "A cég típusa mező kitöltése kötelező,ha a Cég mező ki van jelölve",
            "ado_szam" => "Az adószám mező kitöltése kötelező,ha a Cég mező ki van jelölve",
            "bankszamlaszam" => "A bankszámlaszám megadása kitöltése kötelező,ha a Cég mező ki van jelölve",
            "orszag" =>"Az ország mező kitöltése kötelező",
            "iranyitoszam" => "Az irányítószám mező kitöltése kötelező",
            "varos" => "A város mező kitöltése kötelező",
            "utca" => "Az utca mező kitöltése kötelező",
            "utca_jellege" => "Az utca jellege mező kitöltése kötelező",
            "hazszam" => "A házszám mező kitöltése kötelező",
            "epulet" => "Az épület mező kitöltése kötelező",
            "lepcsohaz" => "A lépcsőház mező kitöltése kötelező",
            "emelet" => "Az emelet mező kitöltése kötelező",
            "ajto" => "Az ajtó mező kitöltése kötelező",
        ];
    }
}
