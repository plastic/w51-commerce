<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $table = 'co_blog_post';

    public $timestamps = false;

    protected $fillable = [
        'tx_titulo',
        'tx_conteudo',
        'fk_id_categoria',
        'fk_id_autor',
        'st_publicado',
        'tx_imagem',
        'dh_cadastro',
        'dh_atualizado',
    ];

    public $primaryKey = 'id_blog_post';

    public function categoria()
    {
        return $this->hasOne(BlogCategoria::class, 'id_blog_categoria', 'id_categoria');
    }
    // public function autor()
    // {
    //     return $this->hasOne(BlogAutor::class, 'id_blog_autor', 'fk_id_autor');
    // }
}
