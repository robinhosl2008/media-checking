<?php

namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;

class EditarUsuarioRequest extends FormRequest
{
    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;
    
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
        $trocaSenha = $this->troca_senha;
        
        return [
            'id'             => 'required|integer',
            'nome'           => 'required|string',
            'email'          => 'required|email',
            'troca_senha'    => '',
            'senha'          => ($trocaSenha) ? 'required|string' : '',
            'confirma_senha' => ($trocaSenha) ? 'required|string|same:senha' : ''
        ];
    }

    public function messages(): array
    {
        return [
            'nome'  => ['nome', 'O nome do usuário deve ser informado.'],
            'email' => ['email', 'O e-mail do usuário não foi informado ou não é um e-mail válido.'],
            'senha' => ['senha', 'Informe uma senha para o usuário.'],
            'confirma_senha' => ['confirma_senha', 'Você não informou a senha ou não são iguais.']
        ];
    }
}
