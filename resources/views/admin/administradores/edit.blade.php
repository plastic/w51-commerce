@extends('layouts/contentLayoutMaster')

@section('title', 'Editar Administrador')

@section('content')

<!-- Page layout -->
@if($errors->any())

<div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
    <div class="alert-body d-flex align-items-center">
        @foreach($errors->all() as $error)
        <i data-feather="info" class="me-50"></i>
        <span>{{ $error }}</span><br>
        @endforeach
    </div>
</div>

@endif


<div class="card">
  <div class="card-body">
    <form method="POST" action="{{route('user.update', ['user' => $user])}}" enctype="multipart/form-data">
        @csrf
    <div class="row">

        <div class="col-md-6 mb-1">
            <label class="form-label">Nome</label>
            <input type="text" class="form-control" name="name" value="{{$user->name}}" required/>
        </div>
        <div class="col-md-6 mb-1">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{$user->email}}" required />
        </div>

        <div class="col-md-6 mb-1">
            <label class="form-label">Senha</label>
            <div class="input-group input-group-merge form-password-toggle">
                <input type="password" class="form-control form-control-merge"
                    name="password"
                     placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                     tabindex="2" />
                     <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
        </div>

        <div class="col-md-6 mb-1">
            <label class="form-label">Confirmar senha</label>
            <div class="input-group input-group-merge form-password-toggle">
                <input type="password" class="form-control form-control-merge"
                  name="confirm_password"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                 tabindex="3" />
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-1">
            <button type="submit" class="btn btn-lg btn-primary btn-next">
                <span class="align-middle d-sm-inline-block d-none">Enviar</span>
                <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
            </button>
        </div>
    </div>
    </form>
  </div>
</div>
<!--/ Page layout -->
@endsection
