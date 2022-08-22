<?php

namespace App\Http\Controllers\Admin;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin\Categoria;
use App\Models\Admin\Departamento;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Rules\CheckImage;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{

    use Upload;

    public function index()
    {
        $btnCreate = ['name' => 'Novo', 'link' =>  route('categoria.create') ];
        $categorias = Categoria::paginate(20);
        return view('admin.categoria.index', ['btnCreate' => $btnCreate, 'categorias' => $categorias]);
    }

    public function create()
    {
        $breadcrumbs = [['name' => "Criar"]];
        $departamentos = Departamento::with('categorias')->get();

        return view('admin.categoria.create', ['breadcrumbs' => $breadcrumbs, 'departamentos' => $departamentos]);
    }

    public function store(Request $request)
    {


        $request->validate([
            'select_dep_cat' => 'required',
            'tx_categoria' => 'required',
        ]);

        $categoria = new Categoria();

        $categoria->tx_categoria = $request->tx_categoria;
        $categoria->tx_descricao = $request->tx_descricao;
        $categoria->st_publicado = $request->st_publicado == 'on' ? 'ATIVO' : 'INATIVO';


        if (strtok($request->select_dep_cat, 1) == 'd') {
            $categoria->id_departamento =  ltrim($request->select_dep_cat, 'd');
        } else {
            $categoria->id_categoria_pai = ltrim($request->select_dep_cat, 'c');
        }

        if (isset($request->banner[0]) && !empty($request->banner[0])) {
            $imagevalidator = Validator::make($request->all(), [
                // 'banner.0' => ['mimes:jpg,jpeg,png', 'max:1024 ', new CheckImage(1440, 500)],
                'banner.0' => ['mimes:jpg,jpeg,png', 'max:1024 '],
            ]);
            if ($imagevalidator->fails()) {
                return redirect()->back()->with('error', $imagevalidator->messages());
            } else {
                $image = $this->upload($request->banner[0], 'categorias', 'image');
                if (!$image) {
                    return response()->json("Ocorreu um erro ao enviar o arquivo", 400);
                }
                $categoria->tx_banner = $image;
            }
        }


        $categoria->dh_cadastro = Carbon::now()->toDateTimeString();
        $categoria->save();


        return redirect('/admin/categorias')->with('msg-sucess', 'Cadastro feito com sucesso');
    }

    public function show(Categoria $categoria)
    {
        $breadcrumbs = [['name' => "Detalhes"]];
        return view('admin.categoria.show', ['breadcrumbs' => $breadcrumbs, 'categoria' => $categoria]);
    }


    public function edit(Categoria $categoria)
    {
        // dd($categoria->departamento->tx_departamento , $categoria->parent);
        $breadcrumbs = [['name' => "Editar"]];
        $departamentos = Departamento::with('categorias')->get();
        return view('admin.categoria.edit', ['breadcrumbs' => $breadcrumbs, 'categoria' => $categoria, 'departamentos' => $departamentos]);
    }

    public function delete(Categoria $categoria)
    {
        $categoria->st_publicado = 'EXCLUIDO';
        $categoria->save();
        return view('admin.categoria.edit', ['categoria' => $categoria]);
    }
}
