<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
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
            'registration_number' => 'required|string|unique:vehicles,registration_number',
            'engine_number' => 'required|string|unique:vehicles,engine_number',
            'chassis_number' => 'required|string|unique:vehicles,chassis_number',
            'model' => 'required|string|min:3',
            'category' => 'required|string|min:3',
            'year_of_manufacture' => 'required|date|before:tomorrow',
            'fuel' => 'required|string|min:3',
            'mileage' => 'nullable|numeric|min:1',
            'description' => 'nullable|string|min:3',
        ];
    }
}
