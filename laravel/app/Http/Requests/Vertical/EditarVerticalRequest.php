<?php

namespace App\Http\Requests\Vertical;

use Illuminate\Foundation\Http\FormRequest;

class EditarVerticalRequest extends FormRequest
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
            'id' => '',
            'nome' => 'required|string',
            'tipo_midia' => 'required|integer',
            'ativo_inativo' => ''
        ];
    }

    public function messages(): array
    {
        return [
            'nome'  => ['nome', 'O nome da vertical deve ser informado.'],
            'tipo_midia' => ['email', 'Selecione um tipo de mídia antes.']
        ];
    }
}
