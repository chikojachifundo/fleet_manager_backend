<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsignmentRequest extends FormRequest
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
            'model'=>'required',
            'description'=>'required',
            'driver_id'=>'required|exists:drivers,id',
            'horse_id'=>'required|exists:vehicles,id',
            'first_trailer'=>'nullable|exists:vehicles,id',
            'second_trailer'=>'nullable|exists:vehicles,id',
            'consignment_route_id'=>'required|exists:consignment_routes,id',
            'date'=>'required|date|before:tomorrow',
            'drivers_allowance'=>'required|numeric|min:1000',
            'first_weight'=>'required|numeric|min:10',
            'second_weight'=>'nullable|numeric|min:10',
        ];
    }
}
