<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VarianteValor extends Model
{
    use HasFactory;

    protected $table = 'co_variante_valor';
    protected $primaryKey = 'id_variante_valor';

    public $timestamps = false;

    protected $fillable = [
        'id_variante',
        'tx_nome_valor',
        'st_publicado',
        'dh_cadastro'
    ];
}
