<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;

    protected $table = 'co_newsletter';
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'tx_pagina',
        'name',
        'email',
        'dh_cadastro',
        'dh_validacao_email',
        'sincronizado',
        'st_ativo',
    ];
}
