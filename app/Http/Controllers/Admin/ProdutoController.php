<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Traits\Upload;
use App\Rules\CheckImage;
use App\Models\Admin\File;
use App\Models\Admin\Marca;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Produto;
use App\Models\Admin\ProdutoVariante;
use App\Models\Admin\Departamento;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreProdutoRequest;
use BaconQrCode\Renderer\Path\Path;

class ProdutoController extends Controller
{

    use Upload;

    public function index()
    {
        $btnCreate = ['name' => 'Novo', 'link' =>  route('produto.create')];
        $produtos = [];
        $departamentos = Departamento::whereNotIn('st_publicado', ['EXCLUIDO'])->with('categorias')->get();
        return view('admin.produto.index', ['btnCreate' => $btnCreate, 'produtos' => $produtos, 'departamentos' => $departamentos]);
    }

    public function create()
    {
        $breadcrumbs = [['name' => "Criar"]];
        $departamentos = Departamento::whereNotIn('st_publicado', ['EXCLUIDO'])->with('categorias')->get();
        $marcas = Marca::all();
        return view('admin.produto.create', ['breadcrumbs' => $breadcrumbs, 'departamentos' => $departamentos, 'marcas' => $marcas]);
    }

    public function store(StoreProdutoRequest $request)
    {

        $produto = new Produto();

        $produto->id_marca = $request->id_marca;
        $produto->tp_produto = $request->tp_produto;
        $produto->tx_produto = $request->tx_produto;
        // $produto->tx_slug =  $this->generateSlug('tx_slug',$request->tx_produto);

        $produto->tx_url = $this->generateSlug('tx_url',$request->tx_url);
        $produto->tx_title = $request->tx_title;
        $produto->tx_meta_description = $request->tx_meta_description;
        $produto->tx_descricao = $request->tx_descricao;
        $produto->tx_url_video = $request->tx_url_video;
        $produto->tp_venda = $request->tp_venda == 'on' ? 'ILIMITADA' : 'ESTOQUE';
        $produto->tp_produto_variante = $request->tp_produto_variante == 'on' ? 'SIM' : 'NAO';
        $produto->tp_destaque = $request->tp_destaque == 'on' ? 'SIM' : 'NAO';
        $produto->tp_google_xml = $request->tp_google_xml == 'on' ? 'SIM' : 'NAO';
        $produto->st_publicado = $request->st_publicado == 'on' ? 'ATIVO' : 'INATIVO';
        $produto->dh_cadastro = Carbon::now()->toDateTimeString();
        $produto->save();
        $produto->categorias()->sync($request->categorias);

        $produtoVariante = new ProdutoVariante();
        $produtoVariante->id_produto = $produto->id_produto;
        $produtoVariante->tx_sku = $request->tx_sku;
        $produtoVariante->tx_isbn_ean = $request->tx_isbn_ean;
        $produtoVariante->vl_preco_custo = $request->vl_preco_custo;
        $produtoVariante->vl_preco_de = $request->vl_preco_de;
        $produtoVariante->vl_preco_por = $request->vl_preco_por;
        $produtoVariante->nr_quantidade = $request->nr_quantidade;
        $produtoVariante->nr_peso = $request->nr_peso;
        $produtoVariante->nr_altura = $request->nr_altura;
        $produtoVariante->nr_profundidade = $request->nr_profundidade;
        $produtoVariante->st_publicado = $request->st_publicado == 'on' ? 'ATIVO' : 'INATIVO';
        $produtoVariante->dh_cadastro = Carbon::now()->toDateTimeString();



        $dataimages = array();
        if ($request->hasfile('images') && !empty($request->hasfile('images'))) {


            foreach ($request->file('images') as $key => $image) {

                $imagevalidator = Validator::make($request->all(), [
                    "images." . $key  => ['mimes:jpg,jpeg,png', 'max:1024 ', new CheckImage(1440, 500)],
                ]);

                if ($imagevalidator->fails()) {
                    dd('validator erro');
                    return redirect()->back()->with('error', $imagevalidator->messages());
                } else {
                    $path = $this->upload($image, 'produtos', $produto->tx_slug . $key);
                    if (!$path) {
                        return response()->json("Ocorreu um erro ao enviar o arquivo", 400);
                    }

                    $dataimages[$image->getClientOriginalName()] =  $path;
                }
            }
        }


        if ($request->serialized) {
            $newdataimages = array();
            foreach (explode(",", $request->serialized)  as  $imagename) {
                array_push($newdataimages, $dataimages[$imagename]);
            }
            $dataimages = $newdataimages;
        }

        if (($request->hasfile('images') && !empty($request->hasfile('images'))) || $request->serialized) {
            $i=1;
            foreach ($dataimages as $key => $dataimage) {
                if($i == 1){
                    $produtoVariante->tx_thumb = $dataimage;
                }

                $produtoVariante->{"tx_imagem_".($i)} = $dataimage;

                $i++;
            }
        }


        $produtoVariante->save();

        $produto->id_produto_variante = $produtoVariante->id_produto_variante;
        $produto->save();
    }

    private function generateSlug($column , $texto)
    {
        if (Produto::where($column, '=', $slug = Str::slug($texto))->exists()) {
            $max = Produto::where($column, $texto)->latest('id_produto')->skip(1)->value($column);
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function ($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }

    public function export()
    {
        return response()->stream($callback, 200, $headers);
    }
}
