<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin\Categoria;
use App\Models\Admin\Departamento;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
        $departamentos = Departamento::with('categorias')->get();

        return view('admin.categoria.create', ['breadcrumbs' => $breadcrumbs, 'departamentos' => $departamentos]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'id_departamento' => 'required | ',
            'tx_departamento' => 'required',
            'tx_descricao' => 'required',
        ]);

        $categoria = new Categoria();

        $categoria->tx_categoria = $request->tx_categoria;
        $categoria->tx_descricao = $request->tx_descricao;
        $categoria->st_publicado = $request->st_publicado == 'on' ? 'ATIVO' : 'INATIVO';



        if(strtok($request->select_dep_cat, 1) == 'd'){
            $categoria->id_departamento =  ltrim($request->select_dep_cat, 'd') ;

        }else{
            $categoria->id_categoria_pai = ltrim($request->select_dep_cat, 'c');

        }

        $categoria->dh_cadastro = Carbon::now()->toDateTimeString();
         $categoria->save();


        return redirect('/admin/categorias')->with('msg-sucess', 'Cadastro feito sucesso');
    }

    public function show(Categoria $categoria)
    {
        return view('admin.categoria.show', ['categoria' => $categoria]);
    }


    public function edit(Categoria $categoria)
    {
        return view('admin.categoria.edit', ['categoria' => $categoria]);
    }

    public function delete(Categoria $categoria)
    {
        $categoria->st_publicado = 'EXCLUIDO';
        $categoria->save();
        return view('admin.categoria.edit', ['categoria' => $categoria]);
    }



    public function montaArvoreMenu()
    {
    // $departamentos = Departamento::find(2);
    // dd( $departamentos->categorias->count());

    // $categoria = Categoria::with('allChildren')->whereNull('id_categoria_pai')->get();
    // dd($categoria);

    // $allCategorias = Categoria::where('id_departamento', null)->where('st_publicado', 'ATIVO')->get();
    $departamentos = Departamento::where('st_publicado', 'ATIVO')->with('categorias')->get();

    foreach ($departamentos as $departamento) {
        echo $departamento->tx_departamento;
        echo '<hr>';

        if ($departamento->categorias->count() != 0) {
                $this->montaSubCategoria($departamento->categorias);
        }

    }
}

public function montaSubCategoria($categorias , $level = 1)
{

    $espacos = str_repeat('-', $level);
    foreach ($categorias as $categoria) {

        echo $espacos . $categoria->tx_categoria . '(' . $categoria->allChildren->count() . ')';
        echo '<hr>';

        if ($categoria->allChildren->count() != 0 ) {
            $level++;
            self::montaSubCategoria($categoria->allChildren , $level);
            $level = 1;
        }

    }
}


}
