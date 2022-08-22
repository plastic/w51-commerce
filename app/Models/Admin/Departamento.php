<?php

namespace App\Models\Admin;

use App\Models\Admin\Categoria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'co_departamento';
    protected $primaryKey = 'id_departamento';

    public $timestamps = false;

    protected $fillable = [
        'tx_departamento',
        'st_descricao',
        'tx_banner',
        'st_menu_principal',
        'st_publicado',
        'dh_cadastro',
    ];

    public function categorias()
    {
        return $this->hasMany(Categoria::class , 'id_departamento')->with('allChildren')->whereNull('id_categoria_pai');
    }


}
