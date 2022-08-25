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

class ProdutoController extends Controller
{

    use Upload;

    public function index()
    {
        $btnCreate = ['name' => 'Novo', 'link' =>  route('produto.create') ];
        $produtos = [];
        $departamentos = Departamento::whereNotIn('st_publicado', ['EXCLUIDO'])->with('categorias')->get();
        return view('admin.produto.index', ['btnCreate' => $btnCreate, 'produtos' => $produtos, 'departamentos' => $departamentos]);
    }

    public function create()
    {
        $breadcrumbs = [['name' => "Criar"]];
        $departamentos = Departamento::whereNotIn('st_publicado', ['EXCLUIDO'])->with('categorias')->get();
        return view('admin.produto.create', ['breadcrumbs' => $breadcrumbs, 'departamentos' => $departamentos]);
    }

    public function store(Request $request)
    {
        dd($request->all());
        $dataimages = array();
        if ($request->hasfile('images') && !empty($request->hasfile('images'))) {

            foreach ($request->file('images') as $key => $image) {

                $imagevalidator = Validator::make($request->all(), [
                    "images.".$key  => ['mimes:jpg,jpeg,png', 'max:1024 ', new CheckImage(1440, 500)],
                ]);

                if ($imagevalidator->fails()) {
                    dd('validator erro');
                    return redirect()->back()->with('error', $imagevalidator->messages());
                }else{
                    $path = $this->upload($image, 'produtos', 'image-' . $key);
                    if (!$path) {
                        return response()->json("Ocorreu um erro ao enviar o arquivo", 400);
                    }

                    // File::create([
                    //     'model' => 'Product',
                    //     'model_id' => $product->id,
                    //     'url' => $path,
                    //     'type' => 'image'
                    // ]);

                    $dataimages[$image->getClientOriginalName() ] =  $path;
                }

            }
        }

        if ($request->serialized) {
            $newdataimages = array();
            foreach ( explode(",", $request->serialized)  as  $imagename) {
                array_push($newdataimages, $dataimages[ $imagename]);
            }

            foreach ($newdataimages as $order => $image){
                // $file = File::where([
                //     ['model','Product'],
                //     ['model_id', $product->id],
                //     ['url',$image],
                // ])->first();
                // $file->order =  $order;
                // $file-> save();
            }

        }

        dd($dataimages, $newdataimages);

    }


    public function export()
    {

        return response()->stream($callback, 200, $headers);
    }
}
