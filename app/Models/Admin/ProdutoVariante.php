<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoVariante extends Model
{
    use HasFactory;

    protected $table = 'co_produto_variante';
    protected $primaryKey = 'id_produto_variante';

    public $timestamps = false;

    protected $fillable = [
        'id_produto',
        'tx_sku',
        'tx_isbn_ean',
       ' vl_preco_custo',
        'vl_preco_de',
        'vl_preco_por',
        'tx_thumb',
        'tx_imagem_1',
        'tx_imagem_2',
        'tx_imagem_3',
        'tx_imagem_4',
        'nr_quantidade',
        'nr_peso',
        'nr_altura',
        'nr_largura',
        'nr_profundidade',
        'st_publicado',
        'dh_cadastro'
    ];
}
