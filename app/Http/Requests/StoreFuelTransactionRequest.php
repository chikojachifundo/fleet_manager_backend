<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFuelTransactionRequest extends FormRequest
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
            'fuel_id' => 'required|exists:fuels,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'consignment_id' => 'nullable|exists:consignments,id',
            'date' => 'required|date|before_or_equal:today',
            'quantity' => 'required|numeric|min:1',
            'cost_per_litre' => 'required|numeric|min:1',
        ];
    }
}
