<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTyreRequest extends FormRequest
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
            'serial_number' => ['required', 'string', 'max:255', 'unique:tyres,serial_number'],
            'brand' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'size' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:tube,tubeless'],
            'thread_pattern' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:steer,driver,trailer'],
            'year_of_manufacture' => ['required', 'date'],
            'purchase_date' => ['required', 'date'],
            'purchase_cost' => ['required', 'numeric', 'min:0'],
            'supplier' => ['nullable', 'string', 'max:255'],
            'supplier_contact' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'in:in_stock,mounted,in_repair,scrapped'],
        ];
    }
}
