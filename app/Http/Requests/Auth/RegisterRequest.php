<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function messages()
    {
        return [
            'required' => 'O :attribute é uma informação obrigatória',
            'email' => 'O :attribute não está formatado corretamente',
            'max' => 'O :attribute deve ter no máximo o tamanho de :max caracteres',
            'min' => 'O :attribute deve ter no mínimo o tamanho de :min caracteres',
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
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];
    }
}
