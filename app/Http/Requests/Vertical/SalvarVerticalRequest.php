<?php

namespace App\Http\Requests\Vertical;

use Illuminate\Foundation\Http\FormRequest;

class SalvarVerticalRequest extends FormRequest
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
            'tipo_midia' => 'required|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'nome' => ['nome', 'Um nome deve ser informado para a criação da vertical.'],
            'tipo_midia' => ['tipo_midia', 'Um tipo de mídia deve ser selecionado.']
        ];
    }
}
