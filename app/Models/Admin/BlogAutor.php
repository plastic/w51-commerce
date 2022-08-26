<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class BlogAutor extends Model
{
    protected $table = 'co_blog_autor';

    public $timestamps = false;

    protected $fillable = [
    ];

    public $primaryKey = 'id_blog_autor';
}
