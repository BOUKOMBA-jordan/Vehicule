<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleContactRequest extends FormRequest
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
            'firstname' => ['required', 'string', 'min:2', 'max:255'], // Limite à 255 caractères
            'lastname' => ['required', 'string', 'min:2', 'max:255'], // Limite à 255 caractères
            'phone' => ['required', 'string', 'min:9', 'max:15', 'regex:/^[0-9]+$/'], // Limite à 15 chiffres et doit être numérique
            'email' => ['required', 'email', 'min:4', 'max:255'], // Limite à 255 caractères
            'message' => ['required', 'string', 'min:4', 'max:1000'], // Limite à 1000 caractères
            'vehicle_id' => ['required', 'exists:vehicles,id'], // Vérification de l'existence du véhicule
        ];
    }
    
}