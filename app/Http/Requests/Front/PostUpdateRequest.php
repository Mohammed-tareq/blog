<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
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
            'title' => 'required|string|max:50',
            'description' => 'required|string|min:10',
            'category_id' => 'required|exists:categories,id',
            'images' => 'nullable|array|min:1|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'comment_able' => 'nullable|in:on',

        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Post Title',
            'description' => 'Post Description',
            'category_id' => 'Category',
            'images' => 'Post Image',
            'comment_able' => 'Allow Comments',
        ];
    }

}
