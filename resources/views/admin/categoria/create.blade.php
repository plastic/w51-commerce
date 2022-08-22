@extends('layouts/contentLayoutMaster')

@section('title', 'Categoria')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/file-uploaders/dropzone.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection
@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-file-uploader.css')) }}">
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
    
    <form  method="POST" action="{{route('categoria.store')}}" enctype="multipart/form-data">
        @csrf
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="mb-1 col-12">
                    <label class="form-label">Nome</label>
                    <input type="text" class="form-control" name="tx_categoria" placeholder="Nome" required />
                </div>
                <div class="col-md-12 mb-1">
                    <label class="form-label" >Departamento ou Categoria</label>
                    <select class="select2 form-select" id="select-dep-cat" name="select_dep_cat" required>
                        <option value="">Selecione...</option>
                    </select>
                </div>
                <div class="mb-1 col-12">
                    <label class="form-label">Descrição</label>
                    <textarea class="form-control" name="tx_descricao" placeholder="Descrição..." required> </textarea>
                </div>
                <div class="mb-1 col-12">
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
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Banner da categoria</h4>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                Esse banner sera exibido na página da categoria <code>500x500 | jpg.png</code>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/file-uploaders/dropzone.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/forms/form-file-uploader.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>

@endsection

<script type="text/javascript">
    $(document).ready(function() {

        var json =  <?php echo json_encode($departamentos); ?>;

        console.log(json);

        $.each(json, function(i, departamento) {
            $("#select-dep-cat").append('<option value="d'+ departamento.id_departamento +'">'+ departamento.tx_departamento +'</option>');

            if(departamento.categorias.length != 0){
                montaSubCategoria(departamento.categorias)
            }
        });

        function montaSubCategoria(categoria, level = 1){

            $.each(categoria, function(i, categoria, ) {
                espacos = ' &nbsp; &nbsp;'.repeat(level);

                 $("#select-dep-cat").append('<option value="c'+ categoria.id_categoria +'">' + espacos + categoria.tx_categoria +'</option>');

                 if(categoria.all_children.length != 0){
                    level++;
                    montaSubCategoria(categoria.all_children , level)
                    level = 1;
                 }
            });

        }

    });
</script>
