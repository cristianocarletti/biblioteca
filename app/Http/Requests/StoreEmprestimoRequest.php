<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreEmprestimoRequest extends FormRequest
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
            'user_id' => 'required|integer',
            'livro_id' => 'required|integer',
            'data_emprestimo' => 'required|date|min:10',
            'data_devolucao' => 'required|date|min:10',
            'email' => 'required|email|unique:users,email',
            'nome' => 'required|string|max:100',
            'mensagem' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Usuário é obrigatório.',
            'livro_id.required' => 'Livro é obrigatório.',
            'data_emprestimo.required' => 'Data de Empréstimo é obrigatório.',
            'data_emprestimo.min' => 'Data de Empréstimo deve ter no mínimo 10 caracteres.',
            'data_devolucao.required' => 'Data de Devolução é obrigatório.',
            'data_devolucao.min' => 'Data de Devolução deve ter no mínimo 10 caracteres.',
        ];
    }
}
