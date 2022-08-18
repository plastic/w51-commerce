<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::paginate(20);
        return view('admin.categoria.index', ['categorias' => $categorias]);
    }

    public function create()
    {
        $breadcrumbs = [
         ['name' => "Criar"]
        ];
        return view('admin.categoria.create',['breadcrumbs' => $breadcrumbs]);
    }
}
