<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use App\Models\Foglalas;
use Illuminate\Validation\Rule;

class StoreFoglalasRequest extends FormRequest
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
        $foglalasid = $this->input('foglalasid');
        return [
            'foglalaskezdete' => [
                'required',
                'date',
                'after_or_equal:today', // A foglalás kezdete nem lehet a múltban
            ],
            'user_felhasznaloid' => [
                'exists:users,felhasznaloid',
            ],

            'foglalashossza' => [
                'required',
                'numeric',
                'min:1', // A foglalás hossza legalább 1 óra
                'max:8', // A foglalás hossza maximum 8 óra
            ],
            'letszam' => [
                'required',
                'numeric',
                'max:6', // Maximum 6 fő lehet

            ],
            'megjegyzes' => [
                'nullable',
                'string',
                'max:500', // Maximum 1000 karakter lehet
            ],

            //szabály ami lehetővé teszi a meglévő foglalással való módosítást is
            Rule::unique('foglalas')->where(function ($query) use ($foglalasid) {
                $foglalaskezdete = $this->input('foglalaskezdete');
                $felhasznaloid = $this->user()->felhasznaloid;

                $query = $query->where('foglalaskezdete', $foglalaskezdete)
                               ->where('user_felhasznaloid', $felhasznaloid);

                if ($foglalasid) {
                    $query->where('foglalasid', '!=', $foglalasid);
                }

                return $query;
            }),
        ];
    }
    public function messages(): array{
        return[
            "foglalaskezdete.required" => "A foglalás kezdetének a dátumát kötelező megadni",
            "foglalaskezdete.date" => "A foglalás kezdetének a dátumának érvényesnek kell lennie",
            "foglalaskezdete.after_or_equal" => "A foglalás kezdetének jövőbeni dátumnak kell lennie",
            "user_felhasznoid.exists" => "A felhasználó nem létezik",
            "foglalashossza.required" => " A foglalás hosszát kötelező megadni",
            "foglalashossza.numeric" => "A foglalás hosszának számnak kell lennie",
            "foglalashossza.min" => "A foglalás hosszának legalább 1 órának kell lennie",
            "foglalashossza.max" => "A foglalás hossza maximum 8 óra lehet",
            "letszam.required" => "Létszámot kötelező megadni",
            "letszam.numeric" => "A létszámnak számnak kell lennie",
            "letszam.max" => "A létszámnak maximum 6 főnek kell lennie",
            "megjegyzes.string" => "A megjegyzésnek szövegnek kell lennie",
            "megjegyzes.max" => "A megjegyzés maximum 500 karakter lehet",


        ];

    }
}
