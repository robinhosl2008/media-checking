<?php

namespace App\Http\Requests\Produto;

use Illuminate\Foundation\Http\FormRequest;

class SalvarProdutoRequest extends FormRequest
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
            'nome'       => 'required|string',
            'vertical'   => 'required|integer',
            'area_lar'   => '',
            'area_alt'   => '',
            'visual_lar' => 'required',
            'visual_alt' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'nome'       => ['nome', 'O nome do produto deve ser informado.'],
            'vertical'   => ['vertical', 'A vertical deve ser selecionada.'],
            'visual_lar' => ['visual_lar', 'A largura da área visual deve ser informada.'],
            'visual_alt' => ['visual_alt', 'A altura da área visual deve ser informada.'],
        ];
    }
}
