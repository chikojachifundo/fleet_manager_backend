<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSparePartRequest extends FormRequest
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
            'spare_part_code_id' => 'required|exists:spare_part_codes,id',
            'store_id' => 'required|exists:stores,id',
            'serial_number' => 'nullable',
            'quantity' => 'required|numeric|min:1',
            'value' => 'required|numeric|min:1',
            'purchase_date' => 'required|date|before_or_equal:today',
            'supplier' => 'nullable|string',
            'supplier_contact' => 'nullable|string',
        ];
    }
}
