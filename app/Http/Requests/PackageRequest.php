<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation of delivery request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'dimensions' => "required|array",
            'dimensions.weight' => "min:0|integer",
            'dimensions.height' => "min:0|integer",
            'dimensions.width' => "min:0|integer",
            'dimensions.deep' => "min:0|integer",

            'customer_name' => "required|min:2",
            'phone_number' => "required|min:10|max:12|string",
            'email' => 'required|email',
            'delivery_address' => 'required'
        ];
    }
}
