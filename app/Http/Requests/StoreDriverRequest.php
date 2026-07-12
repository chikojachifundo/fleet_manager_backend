<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDriverRequest extends FormRequest
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
            'national_id_number' => 'required|unique:drivers,national_id_number',
            'licence_number' => 'required|unique:drivers,licence_number',
            'passport_number' => 'nullable|unique:drivers,passport_number',
            'firstname' => 'required|string|min:3',
            'surname' => 'required|string|min:3',
            'licence_type' => 'required|string|min:1',
            'gender' => 'required|in:M,F',
            'marital_status' => 'required|in:Single,Married,Widowed',
            'birthdate' => 'nullable|date|before:today',
            'engagement_date' => 'nullable|date|before:today',
            'email' => 'required|email|unique:drivers,email',
            'phone_number' => 'required|unique:drivers,phone_number',
            'physical_address' => 'nullable|string|min:3',
            'next_of_kin_name' => 'nullable|string|min:3',
            'next_of_kin_phone_number' => 'nullable|string|min:8',
            'license_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'national_id_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ];
    }
}
