<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 'id_custom' => "unique:customers",
        ];
    }

    public function messages()
    {
        return [
            // 'id_custom.unique' => 'Mã khách hàng đã được sử dụng',
        ];
    }

    
    /**
     * A method to handle the failed validation.
     *
     * @param Validator $validator The validator instance
     * @throws ValidationException description of the exception
     */
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, redirect()->back()->with('warning', $validator->errors()->first()));
    }
}
