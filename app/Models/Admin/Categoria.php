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

    public function departamento()
    {
        return $this->hasOne(Departamento::class, 'id_departamento');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'id_categoria_pai');
    }

    public function categorias()
    {
        return $this->hasMany(Categoria::class);
    }

    public function children()
    {
        return $this->hasMany(self::class, 'id_categoria_pai');

    }

    public function allChildren()
    {
    return $this->children()->with('allChildren');
    }
}
