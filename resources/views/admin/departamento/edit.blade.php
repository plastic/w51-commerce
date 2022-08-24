@extends('layouts/contentLayoutMaster')

@section('title', 'Departamento')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/file-uploaders/dropzone.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
@endsection
@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-file-uploader.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-departamentos.css')) }}">
@endsection

@section('content')
    <!-- Kick start -->

    @if ($errors->any())
        <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
            <div class="alert-body d-flex align-items-center">
                @foreach ($errors->all() as $error)
                    <i data-feather="info" class="me-50"></i>
                    <span>{{ $error }} | </span>
                @endforeach
            </div>
        </div>
    @endif

    <form  method="POST" action="{{route('departamento.update', ['departamento' => $departamento])}}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="mb-1 col-12">
                        <label class="form-label">Nome</label>
                        <input  id ="firstname" type="text" class="form-control" name="tx_departamento" value="{{$departamento->tx_departamento}}" required />
                    </div>
                    <div class="mb-1 col-12">
                        <label class="form-label">Descrição</label>
                        <textarea id="lastname" class="form-control" name="tx_descricao" required>{{$departamento->tx_descricao}}</textarea>
                    </div>
                    <div class="mb-1 col-6">
                        <div class="d-flex flex-column">
                            <label class="form-check-label mb-50"  >Menu Principal  <a data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Esse departamento sera exibido no menu principal"><i data-feather='alert-circle' ></i></a></label>
                            <div class="form-check form-check-success form-switch">
                                <input type="checkbox" {{$departamento->st_menu_principal == true ? 'checked' : '' }} class="form-check-input" id="customSwitch4"
                                    name="st_menu_principal" />
                            </div>
                        </div>
                    </div>
                    <div class="mb-1 col-6">
                        <div class="d-flex flex-column">
                            <label class="form-check-label mb-50">Publicado</label>
                            <div class="form-check form-check-success form-switch">
                                <input type="checkbox" {{$departamento->st_publicado == 'ATIVO' ? 'checked' : '' }} class="form-check-input" id="customSwitch4"
                                    name="st_publicado" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                          <div class="card-header">
                            <h4 class="card-title">Banner do departamento</h4>
                          </div>
                          <div class="card-body">
                            <p class="card-text">
                              Esse banner sera exibido na página do departamento <code>1440x500 | jpg.png</code>
                            </p>

                               <div id="actions" class="dropzone dropzone-area">
                                    <div  id="allImagesWrapper" class="col-lg-12 d-flex actions">

                                    </div>
                                      <label class="custom-file-label" for="files">
                                        <div class="dz-message" id="dz-message">Clique aqui ou arraste o banner.</div>
                                    </label>
                                    <div class="col-lg-12">
                                      <div class="input-group">
                                        <div class="custom-file">
                                          <input type="file" class="custom-images-input" id="files" name="banner[]"
                                          hidden width=1440 height=500 filesize=1500>

                                           {{-- <div class="dz-message">Drop files here or click to upload.</div> --}}
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <input type="hidden" id="serialized" name="serialized">
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="d-flex justify-content-between">
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="submit-all" class="btn btn-success data-submit me-1">Enviar</button>
                    </div>
                </div>
            </div>
        </div>


    </form>



@endsection


@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    {{-- <script src="{{ asset(mix('js/scripts/forms/form-file-uploader.js')) }}"></script> --}}
    <script src="{{ asset(mix('js/scripts/sortable/html5sortable.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-images.js')) }}"></script>
@endsection
