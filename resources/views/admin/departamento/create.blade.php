@extends('layouts/contentLayoutMaster')

@section('title', 'Departamento')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/file-uploaders/dropzone.min.css')) }}">
@endsection
@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-file-uploader.css')) }}">
@endsection

@section('content')
    <!-- Kick start -->
    <form  method="POST" action="{{route('departamento.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="mb-1 col-12">
                        <label class="form-label">Nome</label>
                        <input type="text" class="form-control" name="tx_departamento" placeholder="Nome" required />
                    </div>
                    <div class="mb-1 col-12">
                        <label class="form-label">Descrição</label>
                        <textarea class="form-control" name="tx_descricao" placeholder="Descrição..." required> </textarea>
                    </div>
                    <div class="mb-1 col-6">
                        <div class="d-flex flex-column">
                            <label class="form-check-label mb-50"  >Menu Principal  <a data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Esse departamento sera exibido no menu principal"><i data-feather='alert-circle' ></i></a></label>
                            <div class="form-check form-check-success form-switch">
                                <input type="checkbox" checked class="form-check-input" id="customSwitch4"
                                    name="st_menu_principal" />
                            </div>
                        </div>
                    </div>
                    <div class="mb-1 col-6">
                        <div class="d-flex flex-column">
                            <label class="form-check-label mb-50">Publicado</label>
                            <div class="form-check form-check-success form-switch">
                                <input type="checkbox" checked class="form-check-input" id="customSwitch4"
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
                              Esse banner sera exibido na página do departamento <code>500x500 | jpg.png</code>
                            </p>
                            {{-- <form action="#" class="dropzone dropzone-area" id="dpz-single-file">
                                <div class="dz-message">Clique aqui ou arraste o banner.</div>
                              </form> --}}
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
                        <button type="submit" class="btn btn-success data-submit me-1">Enviar</button>
                    </div>
                </div>
            </div>
        </div>


    </form>
    <!--/ Kick start -->


    <!--/ Page layout -->
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/file-uploaders/dropzone.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/forms/form-file-uploader.js')) }}"></script>
@endsection
