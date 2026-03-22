<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
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
            'registration_number' => 'required|string',
            'engine_number' => 'required|string',
            'chassis_number' => 'required|string',
            'model' => 'required|string|min:3',
            'category' => 'required|string|min:3',
            'year_of_manufacture' => 'required|date|before:tomorrow',
            'fuel_id' => 'nullable|exists:fuels,id',
            'mileage' => 'nullable|numeric|min:1',
            'description' => 'nullable|string|min:3',
        ];
    }
}
