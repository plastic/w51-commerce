<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'co_produto';
    protected $primaryKey = 'id_produto';

    public $timestamps = false;

    protected $fillable = [
        'id_marca',
        'id_produto_variante',
        'tp_produto',
        'tx_slug',
        'tx_produto',
        'tx_url',
        'tx_title',
        'tx_meta_description',
        'tx_descricao',
        'tx_url_video',
        'tp_venda',
        'tp_google_xml',
        'tp_correio_envio',
        'st_publicado',
        'dh_cadastro'
    ];
}
