<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieFormRequest extends FormRequest
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
            'title' => [
                'required',
                'string'
            ],
            'slug' => [
                'required',
                'string'
            ],
            'release_date' => [
                'required',
                'date'
            ],
            'length' => [
                'required',
                'integer'
            ],
            'description' => [
                'required',
                'string'
            ],
            'mpaa_rating' => [
                'required',
                'string'
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048'
            ],
            'genre' => [
                'required',
                'string'
            ],
            'genre1' => [
                'nullable',
                'string'
            ],
            'genre2' => [
                'nullable',
                'string'
            ],
            'director' => [
                'required',
                'string'
            ],
            'performer' => [
                'required',
                'string'
            ],
            'performer1' => [
                'nullable',
                'string'
            ],
            'performer2' => [
                'nullable',
                'string'
            ],
            'language' => [
                'required',
                'string'
            ],
        ];
    }
}
