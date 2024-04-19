<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFoglalasRequest extends FormRequest
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
            'foglalaskezdete' => [
                'required',
                'date',
                'after_or_equal:today', // A foglalás kezdete nem lehet a múltban
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
                'max:500', // Maximum 500 karakter lehet
            ],
        ];
    }
}

