@extends('layouts/contentLayoutMaster')

@section('title', 'Post')

@section('content')

<!-- Page layout -->
<div class="card">
  <div class="card-body ">
    <div class="row px-1">
        <div class="col-md-12 rounded m-0 p-0">
            <img src="{{ url('imagens/blog/'.$post->tx_imagem)}}" class="w-100">
        </div>
        <div class="col-md-12 mt-5">
            <h1>
                {{$post->tx_titulo}}
            </h1>
            <div>
                {!!$post->tx_conteudo!!}
            </div>
        </div>
        <div class="col-md-12 px-0">
            <table class="table table-striped table-view" style="width: 100%">
                <tr>
                    <td><strong>Id: </strong>{{$post->id_blog_post}}</td>
                </tr>
                @isset($post->categoria->tx_blog_categoria)
                <tr>
                    <td><strong>Categoria: </strong>{{$post->categoria->tx_blog_categoria}}</td>
                </tr>
                @endisset
                <tr>
                    <td><strong>Status: </strong>{{ ucfirst(strtolower($post->st_publicado)) }}</td>
                </tr>
                <tr>
                    <td><strong>Data de Criação: </strong>{{date('d/m/Y H:i', strtotime($post->dh_cadastro))}} </td>
                </tr>
                <tr>
                    <td><strong>Data de Atualização: </strong>{{date('d/m/Y H:i', strtotime($post->dh_atualizado))}} </td>
                </tr>
            </table>
        </div>
    </div>

  </div>
</div>
<div class="d-flex justify-content-end mt-3">
    <a type="submit" class="btn btn-lg btn-primary btn-next" href="{{route('blog.index')}}">
        <i data-feather="arrow-left" class="align-middle ms-sm-25 ms-0"></i>
        <span class="align-middle d-sm-inline-block d-none">Voltar</span>
    </a>
</div>
<!--/ Page layout -->
@endsection
