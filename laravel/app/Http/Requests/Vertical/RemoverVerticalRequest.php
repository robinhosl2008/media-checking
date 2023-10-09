<?php

namespace App\Http\Requests\Vertical;

use Illuminate\Foundation\Http\FormRequest;

class RemoverVerticalRequest extends FormRequest
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
            'id' => 'required|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'id'  => ['id', 'Esta ação não pode ser executada.']
        ];
    }
}
