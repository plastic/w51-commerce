<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index()
    {
         $btnCreate = ['name' => 'Nova', 'link' =>  route('marca.create') ];

        $marcas = Marca::paginate(20);

        return view('admin.marca.index', ['btnCreate' => $btnCreate,'marcas' => $marcas]);
    }
}
