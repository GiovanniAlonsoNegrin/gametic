<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $post = $this->route()->parameter('post');

        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'tags' => 'required',
            'file' => 'required|image',
            'extract' => 'required',
            'body' => 'required'
        ];

        if ($post) {
            $rules['slug'] = 'required|unique:posts,slug,' . $post->id;
            unset($rules['file']);
        }

        return $rules;
    }
}
