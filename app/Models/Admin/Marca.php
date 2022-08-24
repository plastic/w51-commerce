<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $table = 'co_marca';
    protected $primaryKey = 'id_marca';

    public $timestamps = false;

    protected $fillable = [
        'tx_marca',
        'st_publicado',
        'dh_cadastro',
    ];
}
