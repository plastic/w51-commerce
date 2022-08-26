<?php

namespace App\Http\Controllers\Admin;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\BlogPost;
use App\Models\Admin\BlogCategoria;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller {

    use Upload;

    public function index(Request $request)
    {
        $btnCreate = ['name' => 'Novo', 'link' =>  route('blog.post.create') ];

        $posts = BlogPost::whereNotIn('st_publicado', ['EXCLUIDO'])->with('categoria')->paginate(15);
        return view('admin.blog.post.index', ['posts' => $posts, 'btnCreate' => $btnCreate]);
    }
    public function search(Request $request)
    {
        $btnCreate = ['name' => 'Novo', 'link' =>  route('blog.post.create') ];

        $posts = BlogPost::where('tx_titulo', 'LIKE', '%' . $request->search . '%')
        ->whereNotIn('st_publicado', ['EXCLUIDO'])
        ->orWhereHas('categoria', function ($query) use ($request) {
            $query->where('tx_blog_categoria', 'LIKE', '%'. $request->search .'%');
        })
        ->with('categoria')
        ->paginate(15);

        return view('admin.blog.post.index', ['posts' => $posts, 'btnCreate' => $btnCreate, 'search' => $request->search]);
    }

    public function create()
    {
        $breadcrumbs = [['name' => "Criar"]];
        $categorias = BlogCategoria::whereNotIn('st_publicado', ['EXCLUIDO'])->orderBy('tx_blog_categoria')->get();

        return view('admin.blog.post.create', ['breadcrumbs' => $breadcrumbs, 'categorias' => $categorias]);
    }
    public function edit(BlogPost $post)
    {
        $breadcrumbs = [['name' => "Editar"]];
        $categorias = BlogCategoria::whereNotIn('st_publicado', ['EXCLUIDO'])->orderBy('tx_blog_categoria')->get();

        return view('admin.blog.post.edit', ['breadcrumbs' => $breadcrumbs, 'post' => $post,'categorias' => $categorias]);
    }

    public function show(BlogPost $post)
    {
        $breadcrumbs = [['name' => "Detalhes"]];
        return view('admin.blog.post.show', ['breadcrumbs' => $breadcrumbs, 'post' => $post]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'select_categoria' => 'required',
            'tx_titulo' => 'required',
            'tx_conteudo' => 'required',
        ]);

        $post = new BlogPost();

        if($request->tx_conteudo && $request->file('postImages')){
            $request->tx_conteudo = $this->handleQuillImages($request->tx_conteudo,$request->file('postImages'),'blog/content');
        }

        $post->tx_titulo = $request->tx_titulo;
        $post->tx_slug = Str::slug($request->tx_titulo, '-');
        $post->tx_conteudo = $request->tx_conteudo;
        $post->tx_resumo = $request->tx_resumo ;
        $post->st_publicado = $request->st_publicado == 'on' ? 'ATIVO' : 'INATIVO';

        $post->id_categoria =  $request->select_categoria;


        if (isset($request->tx_imagem) && !empty($request->tx_imagem)) {
            $imagevalidator = Validator::make($request->all(), [
                // 'tx_imagem' => ['mimes:jpg,jpeg,png', 'max:1024 ', new CheckImage(1440, 500)],
                'tx_imagem' => ['mimes:jpg,jpeg,png', 'max:1024 '],
            ]);
            if ($imagevalidator->fails()) {
                return redirect()->back()->with('error', $imagevalidator->messages());
            } else {
                $image = $this->upload($request->tx_imagem, 'blog', $post->tx_slug);
                if (!$image) {
                    return response()->json("Ocorreu um erro ao enviar o arquivo", 400);
                }
                $post->tx_imagem = $image;
            }
        }


        $post->dh_cadastro = Carbon::now()->toDateTimeString();
        $post->dh_atualizado = Carbon::now()->toDateTimeString();
        $post->save();

        return redirect('/admin/blog')->with('msg-sucess', 'Post criado com sucesso');
    }

    public function update(Request $request, BlogPost $post)
    {
        $request->validate([
            'select_categoria' => 'required',
            'tx_titulo' => 'required',
            'tx_conteudo' => 'required',
        ]);

        if($request->tx_conteudo && $request->file('postImages')){
            $request->tx_conteudo = $this->handleQuillImages($request->tx_conteudo,$request->file('postImages'),'blog/content');
        }

        $post->tx_titulo = $request->tx_titulo;
        $post->tx_slug = Str::slug($request->tx_titulo, '-');
        $post->tx_conteudo = $request->tx_conteudo;
        $post->tx_resumo = $request->tx_resumo ;
        $post->st_publicado = $request->st_publicado == 'on' ? 'ATIVO' : 'INATIVO';

        $post->id_categoria =  $request->select_categoria;

        if (isset($request->tx_imagem) && !empty($request->tx_imagem)) {
            $imagevalidator = Validator::make($request->all(), [
                // 'tx_imagem' => ['mimes:jpg,jpeg,png', 'max:1024 ', new CheckImage(1440, 500)],
                'tx_imagem' => ['mimes:jpg,jpeg,png', 'max:1024 '],
            ]);
            if ($imagevalidator->fails()) {
                return redirect()->back()->with('error', $imagevalidator->messages());
            } else {
                $image = $this->upload($request->tx_imagem, 'blog', $post->tx_slug);
                if (!$image) {
                    return response()->json("Ocorreu um erro ao enviar o arquivo", 400);
                }
                $post->tx_imagem = $image;
            }
        }

        $post->dh_atualizado = Carbon::now()->toDateTimeString();
        $post->save();

        return redirect('/admin/blog')->with('msg-sucess', 'Post atualizado com sucesso');
    }


    public function delete(BlogPost $post)
    {
        $post->st_publicado = 'EXCLUIDO';
        $post->dh_atualizado = Carbon::now()->toDateTimeString();
        $post->save();
       return redirect('/admin/blog')->with('msg-sucess', 'Post excluido com sucesso');
    }



    public function categorias()
    {
        // $btnCreate = ['name' => 'Novo', 'link' =>  route('blog.categoria.create') ];

        $categorias = BlogCategoria::whereNotIn('st_publicado', ['EXCLUIDO'])->orderBy('tx_blog_categoria')->paginate(20);

        return view('admin.blog.categoria.index', ['categorias' => $categorias]);
    }

    public function catstore(Request $request)
    {

        $request->validate([
            'tx_blog_categoria' => 'required',
        ]);

        $categoria = new BlogCategoria();

        $categoria->tx_blog_categoria= $request->tx_blog_categoria;
        $categoria->tx_blog_categoria_slug = Str::slug($request->tx_blog_categoria, '-');
        $categoria->st_publicado = $request->st_publicado == 'on' ? 'ATIVO' : 'INATIVO';

        $categoria->dh_cadastro = Carbon::now()->toDateTimeString();
        $categoria->save();


        return redirect('/admin/blog/categorias')->with('msg-sucess', 'Categoria cadastrada com sucesso');
    }
    public function catupdate(Request $request)
    {
        $request->validate([
            'id_blog_categoria' => 'required',
            'tx_blog_categoria' => 'required',
        ]);

        $categoria = BlogCategoria::where('id_blog_categoria', $request->id_blog_categoria)->first();

        $categoria->tx_blog_categoria= $request->tx_blog_categoria;
        $categoria->tx_blog_categoria_slug = Str::slug($request->tx_blog_categoria, '-');
        $categoria->st_publicado = $request->st_publicado == 'on' ? 'ATIVO' : 'INATIVO';
        $categoria->save();

        return redirect('/admin/blog/categorias')->with('msg-sucess', 'Categoria atualizada com sucesso');
    }
    public function catdelete(BlogCategoria $categoria)
    {
        $categoria->st_publicado = 'EXCLUIDO';
        $categoria->save();
       return redirect('/admin/blog/categorias')->with('msg-sucess', 'Categoria excluida com sucesso');
    }
    public function catsearch(Request $request)
    {
        $btnCreate = ['name' => 'Novo', 'link' =>  route('blog.post.create') ];

        $categorias = BlogCategoria::where('tx_blog_categoria', 'LIKE', '%' . $request->search . '%')
        ->orderBy('tx_blog_categoria')
        ->whereNotIn('st_publicado', ['EXCLUIDO'])
        ->paginate(15);

        return view('admin.blog.categoria.index', ['categorias' => $categorias, 'search' => $request->search]);
    }


    public function export(Request $request)
    {
        $fileName = 'blog-'.str_replace(' ', '_', now()).'.csv';
        $posts = BlogPost::whereNotIn('st_publicado', ['EXCLUIDO'])->with('categoria')->get();

        $search = $request->search;
        if($search){
            $posts = BlogPost::where('tx_titulo', 'LIKE', '%' . $request->search . '%')
            ->whereNotIn('st_publicado', ['EXCLUIDO'])
            ->orWhereHas('categoria', function ($query) use ($request) {
                $query->where('tx_blog_categoria', 'LIKE', '%'. $request->search .'%');
            })
            ->with('categoria')
            ->get();
        }

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array( 'ID', mb_convert_encoding('Título', "iso-8859-15"), mb_convert_encoding('Conteúdo', "iso-8859-15"), 'Categoria', 'Imagem','Data de cadastro', mb_convert_encoding('Data de atualização', "iso-8859-15"),'Status');

        $callback = function() use($posts, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns,';');

            foreach ($posts as $post) {
                $row['ID']  = $post->id_blog_post;
                $row['Título']    = mb_convert_encoding($post->tx_titulo, "iso-8859-15") ;
                $row['Conteúdo']    = mb_convert_encoding($post->tx_conteudo, "iso-8859-15");
                $row['Categoria']    = mb_convert_encoding($post->categoria->tx_blog_categoria, "iso-8859-15");
                $row['Imagem']    = $post->tx_imagem;
                $row['Data de cadastro']  = $post->dh_cadastro;
                $row['Data de atualização']  = $post->dh_atualizado == '0000-00-00 00:00:00' ? '' : $post->dh_atualizado;
                $row['Status']  = $post->st_publicado;

                fputcsv($file,
                array(
                    $row['ID'],
                    $row['Título'],
                    $row['Conteúdo'],
                    $row['Categoria'],
                    $row['Imagem'],
                    $row['Data de cadastro'],
                    $row['Data de atualização'],
                    $row['Status']
                ),';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

}
