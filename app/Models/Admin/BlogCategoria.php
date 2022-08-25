<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class BlogCategoria extends Model
{
    protected $table = 'ib_blog_categoria';

    public $timestamps = false;

    protected $fillable = [
    ];

    public $primaryKey = 'id_blog_categoria';
}
