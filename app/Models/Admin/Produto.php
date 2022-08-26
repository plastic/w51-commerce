<?php

namespace App\Models\Admin;

use Illuminate\Support\Str;
use App\Models\Admin\Categoria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'co_produto';
    protected $primaryKey = 'id_produto';

    public $timestamps = false;

    protected $fillable = [
        'id_marca',
        'tp_produto',
        'tx_slug',
        'tx_produto',
        'tx_url',
        'tx_title',
        'tx_meta_description',
        'tx_descricao',
        'tx_url_video',
        'tp_venda',
        'tp_produto_variante',
        'nr_total_variantes',
        'tp_destaque',
        'tp_google_xml',
        'tp_correio_envio',
        'st_publicado',
        'dh_cadastro'
    ];

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'co_produto_categoria', 'id_produto' ,'id_categoria');
    }
}
