<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
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
            'role_name' => 'required|string|min:1|unique:roles',
            'description' => 'required|string|min:1',
        ];
    }

    public function messages()
    {
        return [
            'role_name.required' => 'Tên vai trò là bắt buộc.',
            'role_name.string' => 'Tên vai trò phải là một chuỗi.',
            'role_name.min' => 'Tên vai trò phải có ít nhất 1 ký tự.',
            'role_name.unique' => 'Tên vai trò đã tồn tại.',
            
            'description.required' => 'Mô tả là bắt buộc.',
            'description.string' => 'Mô tả phải là một chuỗi.',
            'description.min' => 'Mô tả phải có ít nhất 1 ký tự.',
        ];
    }
}
