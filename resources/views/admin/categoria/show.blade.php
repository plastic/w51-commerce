@extends('layouts/contentLayoutMaster')

@section('title', 'Categoria')

@section('content')

<!-- Page layout -->
<div class="card">
  <div class="card-body ">
    <div class="row px-1">
        <div class="col-md-12 rounded m-0 p-0">
            <table class="table table-striped table-view" style="width: 100%">
                <tr>
                    <td><strong>Id: </strong>{{$categoria->id_categoria}}</td>
                </tr>
                <tr>
                    <td><strong>Nome: </strong>{{$categoria->tx_categoria}}</td>
                </tr>
                <tr>
                    <td><strong>Departamento: </strong>{{$categoria->departamento->tx_departamento}}</td>
                </tr>
                <tr>
                    <td><strong>Descrição: </strong>{{$categoria->tx_descricao}}</td>
                </tr>
                <tr>
                    <td><strong>Banner: </strong></td>
                </tr>
                <tr>
                    <td><strong>Status: </strong>{{ ucfirst(strtolower($categoria->st_publicado)) }}</td>
                </tr>
                <tr>
                    <td><strong>Data de Criação: </strong>{{date('d/m/Y H:i', strtotime($categoria->dh_cadastro))}} </td>
                </tr>
            </table>
        </div>
    </div>

  </div>
</div>
<div class="d-flex justify-content-end mt-3">
    <a type="submit" class="btn btn-lg btn-primary btn-next" href="{{route('categoria.index')}}">
        <i data-feather="arrow-left" class="align-middle ms-sm-25 ms-0"></i>
        <span class="align-middle d-sm-inline-block d-none">Voltar</span>
    </a>
</div>
<!--/ Page layout -->
@endsection
