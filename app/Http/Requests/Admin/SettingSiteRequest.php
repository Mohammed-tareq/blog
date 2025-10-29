<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingSiteRequest extends FormRequest
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
            'site_name' => "required|string|max:20",
            'logo' => "nullable|image",
            'favicon' => "nullable|image",
            'email' => "required|string|max:30",
            'phone' => "required|string|max:20",
            'street' => "required|string|max:30",
            'city' => "required|string|max:30",
            'country' => "required|string|max:30",
            'facebook' => "required|string|max:50",
            'twitter' => "required|string|max:50",
            'instagram' => "required|string|max:50",
            'youtube' => "required|string|max:50",
            'linkedin' => "required|string|max:50",
            'desc_for_site' => "required|string|max:300",
        ];
    }
}
