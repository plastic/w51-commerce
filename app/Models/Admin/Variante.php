<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variante extends Model
{
    use HasFactory;

    protected $table = 'co_variante';
    protected $primaryKey = 'id_variante';

    public $timestamps = false;

    protected $fillable = [
        'tx_variante',
        'tx_nome_exibicao',
        'st_publicado',
        'dh_cadastro'
    ];

    public function atributos()
    {
        return $this->hasMany(VarianteValor::class, 'id_variante')->whereNotIn('st_publicado', ['EXCLUIDO'])->get();
    }
}


