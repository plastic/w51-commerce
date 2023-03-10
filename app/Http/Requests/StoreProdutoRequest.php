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
        if($this->input('tp_produto_variante') != 'on'){
            return [
                'tx_produto' => 'required|max:255',
                'categorias[]' => 'required',
                'vl_preco_custo' => 'numeric|nullable',
                'vl_preco_de' => 'required|numeric',
                'vl_preco_por' => 'numeric|nullable',
                'nr_quantidade' => 'numeric|nullable',
                'nr_peso' => 'required|numeric',
                'nr_altura' => 'required|numeric',
                'nr_largura' => 'required|numeric',
                'nr_profundidade' => 'required|numeric',
                'tx_url' => 'required',
                'tx_title' => 'required',
                'tx_url_video' => 'url|nullable',

            ];
        }
        if ( $this->input('tp_produto_variante') == 'on' and $this->input('peso_dimensoes_check') == 'on' ) {
            return [
                'tx_produto' => 'required|max:255',
                'categorias[]' => 'required',

                'nr_peso' => 'required|numeric',
                'nr_altura' => 'required|numeric',
                'nr_largura' => 'required|numeric',
                'nr_profundidade' => 'required|numeric',
                'tx_url' => 'required',
                'tx_title' => 'required',
                'tx_url_video' => 'url|nullable',

                'variante.*.nameVariante' => 'required',
                'variante.*.preco_custo' => 'required',
                'variante.*.preco_de' => 'required',
                'variante.*.preco_por' => 'required',
                'variante.*.quantidade' => 'required',
            ];
        }
        if ( $this->input('tp_produto_variante') == 'on' and $this->input('peso_dimensoes_check') != 'on' ) {
            return [
                'tx_produto' => 'required|max:255',
                'categorias[]' => 'required',
                'tx_url' => 'required',
                'tx_title' => 'required',
                'tx_url_video' => 'url|nullable',

                'variante.*.nameVariante' => 'required',
                'variante.*.preco_custo' => 'required',
                'variante.*.preco_de' => 'required',
                'variante.*.preco_por' => 'required',
                'variante.*.quantidade' => 'required',

                'variante.*.peso' => 'required',
                'variante.*.altura' => 'required',
                'variante.*.largura' => 'required',
                'variante.*.profundidade' => 'required',
            ];
        }


    }

    public function messages()
    {
        return [
            'tx_produto.required' => 'Campo nome ?? obrigatorio!',
            'categorias[].required' => 'Selecione alguma categoria!',

            'vl_preco_custo.numeric' => 'Pre??o de custo deve ser um n??mero!',
            'vl_preco_de.required' => 'Pre??o de venda ?? obrigatorio!',
            'vl_preco_de.numeric' => 'Pre??o de venda deve ser um n??mero!',
            'vl_preco_por.numeric' => 'Pre??o promocional deve ser um n??mero!',
            'nr_quantidade.numeric' => 'Quantidade deve ser um n??mero!',
            'nr_peso.numeric' => 'Peso deve ser um n??mero!',
            'nr_altura.numeric' => 'Altura deve ser um n??mero!',
            'nr_largura.numeric' => 'Largura deve ser um n??mero!',
            'nr_profundidade.numeric' => 'Profundidade deve ser um n??mero!',

            'tx_url.required' => 'Campo url do produto ?? obrigatorio!',
            'variante.*.nameVariante' => 'O nome do produto com varia????o ?? obrigatorio!',
        ];
    }
}
