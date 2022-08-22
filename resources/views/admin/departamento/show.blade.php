@extends('layouts/contentLayoutMaster')

@section('title', 'Departamento')

@section('content')

<!-- Page layout -->
<div class="card">
  <div class="card-body ">
    <div class="row px-1">
        <div class="col-md-12 rounded m-0 p-0">
            <table class="table table-striped table-view" style="width: 100%">
                <tr>
                    <td><strong>Id: </strong>{{$departamento->id_departamento}}</td>
                </tr>
                <tr>
                    <td><strong>Nome: </strong>{{$departamento->tx_departamento}}</td>
                </tr>
                <tr>
                    <td><strong>Descrição: </strong>{{$departamento->tx_descricao}}</td>
                </tr>
                <tr>
                    <td><strong>Banner: </strong></td>
                </tr>
                <tr>
                    <td><strong>Menu Principal: </strong>{{$departamento->st_menu_principal ? 'sim' : 'nao'}}</td>
                </tr>
                <tr>
                    <td><strong>Status: </strong>{{ ucfirst(strtolower($departamento->st_publicado)) }}</td>
                </tr>
                <tr>
                    <td><strong>Data de Criação: </strong>{{$departamento->dh_cadastro}}</td>
                </tr>
            </table>
        </div>
    </div>

  </div>
</div>
<div class="d-flex justify-content-end mt-3">
    <a type="submit" class="btn btn-lg btn-primary btn-next" href="{{route('departamento.index')}}">
        <i data-feather="arrow-left" class="align-middle ms-sm-25 ms-0"></i>
        <span class="align-middle d-sm-inline-block d-none">Voltar</span>
    </a>
</div>
<!--/ Page layout -->
@endsection
