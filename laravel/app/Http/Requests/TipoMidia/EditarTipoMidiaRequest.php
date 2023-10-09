<?php

namespace App\Http\Requests\TipoMidia;

use Illuminate\Foundation\Http\FormRequest;

class EditarTipoMidiaRequest extends FormRequest
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
            'id'   => '',
            'nome' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'nome' => ['nome', 'O nome do tipo de mídia deve ser informado.']
        ];
    }
}
