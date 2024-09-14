<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VehicleFormRequest extends FormRequest
{
    public function rules()
{
    return [
        'make' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'year' => 'required|integer',
        'fuel_type' => 'required|string|max:50',
        'mileage' => 'nullable|integer',
        'color' => 'nullable|string|max:50',
        'price' => 'required|numeric',
        'city' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'location' => 'nullable|string|max:255',
        'registration_number' => 'nullable|string|max:255',
        'owner_name' => 'nullable|string|max:255',
        'owner_phone' => 'nullable|string|max:20',
        'reference' => 'nullable|string|max:10|unique:vehicles,reference,', // Validation unique mais permet la valeur actuelle
        'options' => 'nullable|array',
        'options.*' => 'exists:options,id',
        'images.*' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
    ];
}


}