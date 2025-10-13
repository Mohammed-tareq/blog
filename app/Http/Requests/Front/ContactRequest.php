<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'required|string|max:55',
            'email' => 'required|email|string',
            'phone' => 'required|string|max:20',
            'title' => 'required|string|max:60',
            'message' => 'required|string|max:500',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Your Name',
            'email' => 'Your Email',
            'phone' => ' Your Phone',
            'title' => 'Subject Title',
            'message' => ' Body Message',
        ];
    }
}
