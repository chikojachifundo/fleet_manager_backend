<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsignmentRouteRequest extends FormRequest
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
            'code' => 'string|required|unique:consignment_routes,code',
            'name' => 'string|required|unique:consignment_routes,name',
            'mileage' => 'required|numeric|between:1,999999.99',
            'description' => 'string|nullable',
        ];
    }
}
