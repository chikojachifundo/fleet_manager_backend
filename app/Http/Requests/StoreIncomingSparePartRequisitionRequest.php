<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIncomingSparePartRequisitionRequest extends FormRequest
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
            'spare_part_id' => 'required|exists:spare_parts,id',
            'date' => 'required|date|before:tomorrow',
            'quantity' => 'required|numeric|min:1',
            'supplier_name'=>'nullable|string',
            'supplier_contact'=>'nullable|string',
            'value'=>'nullable|numeric|min:1',
            'description'=>'nullable|string',
        ];
    }
}
