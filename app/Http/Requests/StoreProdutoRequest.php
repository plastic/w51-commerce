<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProdutoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'tx_produto' => 'required|max:255',
            // 'categoria[]' => 'required',
            'vl_preco_custo' => 'numeric',
            'vl_preco_de' => 'required|numeric',
            'vl_preco_por' => 'numeric',
            'nr_quantidade' => 'numeric',
            'nr_peso' => 'numeric',
            'nr_altura' => 'numeric',
            'nr_largura' => 'numeric',
            'nr_profundidade' => 'numeric',
            'tx_url' => 'required',
            'tx_url_video' => 'url',

        ];
    }

    public function messages()
    {
        return [
            'tx_produto.required' => 'Campo nome é obrigatorio!',
            'categoria[].required' => 'Selecione alguma categoria!',

            'vl_preco_custo.numeric' => 'Preço de custo deve ser um número!',
            'vl_preco_de.required' => 'Preço de venda é obrigatorio!',
            'vl_preco_de.numeric' => 'Preço de venda deve ser um número!',
            'vl_preco_por.numeric' => 'Preço promocional deve ser um número!',
            'nr_quantidade.numeric' => 'Quantidade deve ser um número!',
            'nr_peso.numeric' => 'Peso deve ser um número!',
            'nr_altura.numeric' => 'Altura deve ser um número!',
            'nr_largura.numeric' => 'Largura deve ser um número!',
            'nr_profundidade.numeric' => 'Profundidade deve ser um número!',

            'tx_url.required' => 'Campo url do produto é obrigatorio!',
        ];
    }
}