<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsuarioRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|string',
            'email' => 'required|email',
            'senha' => 'required|string',
            'confirma_senha' => 'required|string'
        ];
    }

    public function messages(): array
    {
        return [
            'nome' => ['nome', 'O nome do usuário deve ser informado e deve ter ao menos 3 caracteres.'],
            'email' => ['email', 'O e-mail do usuário não foi informado ou não é um e-mail válido.'],
            'senha' => ['senha', 'Informe uma senha para o usuário.'],
            'confirma_senha' => ['confirma_senha', 'Deve confirmar sua senha.']
        ];
    }
}
