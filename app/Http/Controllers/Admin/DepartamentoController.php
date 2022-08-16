<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function index()
    {
        $departamentos = Departamento::paginate(20);
        return view('admin.departamento.index', ['departamentos' => $departamentos]);
    }

    public function create()
    {
        $breadcrumbs = [
         ['name' => "Criar"]
        ];
        return view('admin.departamento.create',['breadcrumbs' => $breadcrumbs]);
    }
}
