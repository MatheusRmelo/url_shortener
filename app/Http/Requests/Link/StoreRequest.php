<?php

namespace App\Http\Requests\Link;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function messages()
    {
        return [
            'required' => 'O :attribute é uma informação obrigatória',
            'string' => 'O :attribute deve ser uma string',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'url' => 'required|string'
        ];
    }
}
