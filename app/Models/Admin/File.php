<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'id',
        'url',
        'type',
        'model',
        'model_id',
        'created_at',
        'updated_at',
    ];
}
