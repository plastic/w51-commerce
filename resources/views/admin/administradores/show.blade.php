@extends('layouts/contentLayoutMaster')

@section('title', 'Administrador')

@section('content')

<!-- Page layout -->
<div class="card">
  <div class="card-body ">
    <div class="row px-1">
        <div class="col-md-12 rounded m-0 p-0">
            <table class="table table-striped table-view" style="width: 100%">
                <tr>
                    <td><strong>Nome: </strong>{{$user->name}}</td>
                </tr>
                <tr>
                    <td><strong>E-mail: </strong>{{$user->email}}</td>
                </tr>
                <tr>
                    <td><strong>Criado em: </strong>{{date('d/m/Y H:i', strtotime($user->created_at))}}</td>
                </tr>
                <tr>
                    <td><strong>Atualizado em: </strong>{{date('d/m/Y H:i', strtotime($user->updated_at))}}</td>
                </tr>
            </table>
        </div>

    </div>

  </div>
</div>

<div class="d-flex justify-content-end mt-3">
    <a type="submit" class="btn btn-lg btn-primary btn-next" href="{{route('user.index')}}">
        <i data-feather="arrow-left" class="align-middle ms-sm-25 ms-0"></i>
        <span class="align-middle d-sm-inline-block d-none">Voltar</span>
    </a>
</div>
<!--/ Page layout -->
@endsection
