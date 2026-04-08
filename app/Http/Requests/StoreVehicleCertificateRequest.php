<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleCertificateRequest extends FormRequest
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
            'vehicle_id' => 'required|exists:vehicles,id',
            'type' => 'required|in:insurance,cof',
            'issue_date' => 'required|date|before_or_equal:today',
            'expiry_date' => 'required|date|after:issue_date',
            'total_cost' => 'required|numeric|min:0',
            'insurance_type' => 'nullable|in:comprehensive,third-party',
            'insurance_company' => 'nullable|string',
            'insurance_number' => 'nullable|string',
            'insurance_company_address' => 'nullable|string',
            'insurance_company_telephone' => 'nullable|string',
        ];
    }
}
