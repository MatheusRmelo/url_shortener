<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function messages()
    {
        return [
            'required' => 'O :attribute é uma informação obrigatória',
            'email' => 'O :attribute não está formatado corretamente',
            'string' => 'O :attribute deve ser uma string',
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
            'email' => 'required|email',
            'password' => 'required|min:6',
            'device' => 'required|string'
        ];
    }
}