<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTyreMovementRequest extends FormRequest
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
            '*.vehicle_id' => 'required|exists:vehicles,id',
            '*.position_id' => ['required', 'integer', 'exists:positions,id'],
            '*.tyre_id' => ['required', 'integer', 'exists:tyres,id'],
            '*.fitted_date' => ['required', 'date'],
            '*.removed_date' => ['nullable', 'date', 'after_or_equal:*.fitted_date'],
            '*.odometer_at_fit' => ['required', 'numeric', 'min:0'],
            '*.odometer_at_removal' => ['nullable', 'numeric', 'min:0', 'gte:*.odometer_at_fit'],
        ];
    }
}
