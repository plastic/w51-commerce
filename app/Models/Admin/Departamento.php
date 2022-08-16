<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'co_departamento';
    protected $primaryKey = 'id_departamento';

    protected $fillable = [
        'tx_departamento',
        'tx_banner',
        'st_menu_principal',
        'st_publicado',
        'st_publicado',
        'dh_cadastro',
    ];
}
