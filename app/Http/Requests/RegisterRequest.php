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
            "jelszo_megerositese" => "required|string|min:8",
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
}
