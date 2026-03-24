<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleServiceRequest extends FormRequest
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
            'description' => ['required', 'string'],
            'vehicle_id' => ['required', 'exists:vehicles,id'],
            'date' => ['required', 'date'],
            'contractor' => ['nullable', 'string'],
            'contractor_contact' => ['nullable', 'string'],
            'consignment_id' => ['nullable', 'exists:consignments,id'],
            //  ARRAY VALIDATION
            'spare_parts' => ['nullable', 'array'],
            'spare_parts.*.spare_part_id' => ['required', 'exists:spare_parts,id'],
            'spare_parts.*.quantity' => ['required', 'numeric', 'min:1'],
            'spare_parts.*.description' => ['nullable', 'string'],
        ];
    }
}
