<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLubricantRequest extends FormRequest
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
            'code'=>'required|unique:lubricants,code',
            'name'=>'required|unique:lubricants,name',
            'brand'=>'required|string|min:3',
            'type'=>'required|string|min:3',
            'cost_per_litre'=>'required|numeric|min:1',
            'minimum_stock'=>'required|numeric|min:1',
            'current_stock'=>'required|numeric|min:1',
            'description'=>'required|string|min:3',
        ];
    }
}
