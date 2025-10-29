<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string|max:30',
            'user_name' => 'required|string|max:30|unique:users,user_name',
            'email' => 'required|email|max:50|unique:users,email',
            'email_verify' => 'required|in:0,1',
            'status' => 'required|in:0,1',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
            'phone' => 'required|string|unique:users,phone',
            'city' => 'nullable|string|max:50',
            'country' => 'nullable|string|max:50',
            'street' => 'nullable|string|max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
