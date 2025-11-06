<?php

namespace App\Http\Requests\Admin\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
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
        $id = $this->route('admin');
        return [
            'name' => 'required|string|max:30',
            'user_name' => 'required|string|max:30|unique:admins,user_name,'.$id,
            'email' => 'required|email|max:50|unique:admins,email,'.$id,
            'authoriz_id' => 'required|exists:authorizs,id',
            'password' => 'nullable|string|min:8|confirmed',
            'password_confirmation' => 'nullable',
        ];
    }
}
