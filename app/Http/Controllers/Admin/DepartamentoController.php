<?php

namespace App\Http\Controllers\Admin;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin\Departamento;
use App\Models\Admin\File;
use App\Http\Controllers\Controller;
use App\Rules\CheckImage;
use Illuminate\Support\Facades\Validator;

class DepartamentoController extends Controller
{

    use Upload;

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
        return view('admin.departamento.create', ['breadcrumbs' => $breadcrumbs]);
    }

    public function store(Request $request)
    {
        $request->validate([

            'tx_departamento' => 'required',
            'tx_descricao' => 'required',
        ]);


        $departamento = new Departamento();
        $departamento->tx_departamento = $request->tx_departamento;
        $departamento->tx_descricao = $request->tx_descricao;
        $departamento->st_menu_principal =  $request->st_menu_principal == 'on' ? true : false;
        $departamento->st_publicado = $request->st_publicado == 'on' ? 'ATIVO' : 'INATIVO';
        $departamento->dh_cadastro = Carbon::now()->toDateTimeString();

        if (isset($request->banner[0]) && !empty($request->banner[0])) {
            $imagevalidator = Validator::make($request->all(), [
                'banner.0' => ['mimes:jpg,jpeg,png', 'max:1024 ', new CheckImage(1440, 500)],
            ]);
            if ($imagevalidator->fails()) {
                return redirect()->back()->with('error', $imagevalidator->messages());
            } else {
                $image = $this->upload($request->banner[0], 'departamentos', 'image');
                if (!$image) {
                    return response()->json("Ocorreu um erro ao enviar o arquivo", 400);
                }
                $departamento->tx_banner = $image;
            }
        }

        $departamento->save();

        return redirect('/admin/departamentos')->with('msg-sucess', 'Cadastro feito sucesso');
    }

    public function show(Departamento $departamento)
    {
        $breadcrumbs = [['name' => "Detalhes"]];
        return view('admin.departamento.show', ['departamento' => $departamento, 'breadcrumbs' => $breadcrumbs]);
    }
}
