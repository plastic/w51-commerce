@extends('layouts/contentLayoutMaster')

@section('title', 'Categoria')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/file-uploaders/dropzone.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
@endsection
@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-file-uploader.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-departamentos.css')) }}">
@endsection

@section('content')
    <!-- Kick start -->
    <form  method="POST" action="{{route('categoria.update')}}" enctype="multipart/form-data">
        @csrf
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="mb-1 col-12">
                    <label class="form-label">Nome</label>
                    <input type="text" class="form-control" name="tx_categoria" placeholder="Nome" value="{{$categoria->tx_categoria}}" required />
                </div>
                <div class="col-md-12 mb-1">
                    <label class="form-label" >Departamento ou Categoria</label>
                    <select class="select2 form-select" id="select-dep-cat" name="select_dep_cat" required>
                        <option value=" {{$categoria->departamento == null ? 'c'.$categoria->parent->id_categoria : 'd'.$categoria->departamento->id_departamento}}">{{$categoria->departamento == null ? $categoria->parent->tx_categoria : $categoria->departamento->tx_departamento }}</option>
                    </select>
                </div>
                <div class="mb-1 col-12">
                    <label class="form-label">Descrição</label>
                    <textarea class="form-control" name="tx_descricao" required> {{$categoria->tx_descricao}}</textarea>
                </div>
                <div class="mb-1 col-12">
                    <div class="d-flex flex-column">
                        <label class="form-check-label mb-50">Publicado</label>
                        <div class="form-check form-check-success form-switch">
                            <input type="checkbox" {{$categoria->st_publicado == 'ATIVO' ? 'checked' : '' }} class="form-check-input" id="customSwitch4"
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
                          Esse banner sera exibido na página do departamento <code>1440x500 | jpg.png</code>
                        </p>


                           <div id="actions" class="dropzone dropzone-area">
                                <div  id="allImagesWrapper" class="col-lg-12 d-flex actions">

                                        <span class="card-newthumb dz-preview dz-processing dz-image-preview dz-error dz-complete" data-uploadname="eles.jpg">
                                            <div class="dz-image">
                                                <img src="{{ url('imagens/categorias/'.$categoria->tx_banner)}}">
                                            </div>
                                            <div class="dz-details">
                                                <div class="dz-size"><span><strong>{{floor(filesize( 'imagens/categorias/'.$categoria->tx_banner ) / 1024)}}</strong> KB</span></div>
                                                <div class="dz-filename"><span>{{ $categoria->tx_banner}}</span></div>
                                            </div>
                                            <a href="#" class="btn btn-outline-danger btn-sm justCreatedCard w-100" onclick="removeOne(event)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>
                                        </span>
                                </div>
                                  <label class="custom-file-label" for="files">
                                    <div class="dz-message filled" id="dz-message">Clique aqui ou arraste o banner.</div>
                                </label>
                                <div class="col-lg-12">
                                  <div class="input-group">
                                    <div class="custom-file">
                                      <input type="file" class="custom-images-input" id="files" name="banner[]"
                                      hidden width=1440 height=500 filesize=1500 value="{{$categoria->tx_banner}}">
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
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/forms/form-file-uploader.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-images.js')) }}"></script>

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
