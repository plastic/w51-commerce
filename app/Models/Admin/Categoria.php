<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'co_categoria';
    protected $primaryKey = 'id_categoria';

    public $timestamps = false;

    protected $fillable = [
        'tx_categoria',
        'tx_descricao',
        'tx_banner',
        'st_publicado',
        'dh_cadastro',
    ];
}
