<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreAutorRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Set to true to allow all requests
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 422));
    }

    public function rules()
    {
        return [
            'nome' => 'required|string|max:100',
            'data_nascimento' => 'required|date|min:10',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Nome é obrigatório.',
            'nome.max' => 'Nome deve ter no máximo 100 caracteres.',
            'data_nascimento.required' => 'Data de Nascimento é obrigatório.',
            'data_nascimento.min' => 'Data de Nascimento deve ter no mínimo 10 caracteres.',
        ];
    }
}
