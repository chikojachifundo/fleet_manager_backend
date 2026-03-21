<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLubricantTransactionRequest extends FormRequest
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
            'lubricant_id' => 'required|exists:lubricants,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'date' => 'required|date|before_or_equal:today',
            'quantity' => 'required|numeric|min:1',
            'cost' => 'numeric|numeric|min:1',
            'type' => 'required|string|in:issue,purchase',
        ];
    }
}
