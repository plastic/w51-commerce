<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin\Departamento;
use App\Http\Controllers\Controller;

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

    public function store(Request $request)
    {
        $request->validate([

            'tx_departamento' => 'required',
            'tx_descricao' => 'required',
        ]);


        $departamento = New Departamento();
        $departamento->tx_departamento = $request->tx_departamento;
        $departamento->tx_descricao = $request->tx_descricao;
        $departamento->st_menu_principal =  $request->st_menu_principal == 'on' ? true : false;
        $departamento->st_publicado = $request->st_publicado == 'on' ? 'ATIVO' : 'INATIVO';
        $departamento->dh_cadastro = Carbon::now()->toDateTimeString();
        $departamento->save();

        dd($departamento);

        return redirect('/admin/administradores')->with('msg-sucess', 'Cadastro feito sucesso');
    }
}
