<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreLivroRequest extends FormRequest
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
            'titulo' => 'required|string|max:100',
            'ano_publicacao' => 'required|integer|min:4,max:4',
        ];
    }

    public function messages()
    {
        return [
            'titulo.required' => 'Título é obrigatório.',
            'titulo.min' => 'Título deve ter no máximo 100 caracteres.',
            'ano_publicacao.required' => 'Ano de Publicação é obrigatório.',
            'ano_publicacao.min' => 'Ano de Publicação deve ter no mínimo 4 caracteres.',
            'ano_publicacao.max' => 'Ano de Publicação deve ter no máximo 4 caracteres.',
        ];
    }
}
