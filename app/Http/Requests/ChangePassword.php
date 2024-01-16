<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePassword extends FormRequest
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
            'password' => 'string|min:6',
            'confirm_password' => 'same:password',
        ];
    }

    public function messages()
    {
        return [
            'password.min' => 'Mật khẩu quá ngắn',
            'confirm_password.same' => 'Xác nhận mật này khác nhau',
        ];
    }
}
