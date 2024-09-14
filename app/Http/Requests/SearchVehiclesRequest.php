<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchVehiclesRequest extends FormRequest
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
            'price' => ['nullable', 'numeric', 'gte:0'], // Prix non négatif
            'mileage' => ['nullable', 'numeric', 'gte:0'], // Kilométrage non négatif
            'year' => ['nullable', 'integer', 'gte:1900', 'lte:' . date('Y')], // Année entre 1900 et l'année actuelle
            'model' => ['nullable', 'string', 'max:255'], // Limite la longueur du modèle à 255 caractères
            'brand' => ['nullable', 'string', 'max:255'], // Limite la longueur de la marque à 255 caractères
        ];
    }
    
}