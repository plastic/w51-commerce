@extends('layouts/contentLayoutMaster')

@section('title', 'Post')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/file-uploaders/dropzone.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
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

    <form  method="POST" action="{{route('blog.post.store')}}" enctype="multipart/form-data">
        @csrf
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="mb-1 col-12">
                    <label class="form-label">Título</label>
                    <input type="text" class="form-control" name="tx_titulo" placeholder="Título" required />
                </div>
                <div class="col-md-12 mb-1">
                    <label class="form-label" >Categoria</label>
                    <select class="select2 form-select" id="select-cat" name="select_categoria" required data-placeholder="Selecione">
                        <option>Selecione</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{$categoria->id_blog_categoria}}">{{$categoria->tx_blog_categoria}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-1 col-12 mb-5 pb-3">
                    <label class="form-label">Texto</label>
                    <div id="editor" >
                        <p>Escreva algo aqui...</p>
                    </div>
                    <textarea name="tx_conteudo" style="display:none" id="hiddenTextArea"></textarea>
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
                        <h4 class="card-title">Imagem do post</h4>
                      </div>
                      <div class="card-body">
                        <p class="card-text">
                          Esse banner sera exibido na página do post e no blog<code>1440x500 | jpg.png</code>
                        </p>


                           <div id="actions" class="dropzone dropzone-area">
                                <div  id="allImagesWrapper" class="col-lg-12 d-flex actions">

                                </div>
                                  <label class="custom-file-label" for="files">
                                    <div class="dz-message " id="dz-message">Clique aqui ou arraste a imagem.</div>
                                </label>
                                <div class="col-lg-12">
                                  <div class="input-group">
                                    <div class="custom-file">
                                      <input type="file" class="custom-images-input" id="files" name="tx_imagem"
                                      hidden width=1440 height=500 filesize=1500>
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
    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/forms/form-file-uploader.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-images.js')) }}"></script>

<script>
     var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['blockquote', 'code-block'],
        ['link','image','video'],

        [{ 'header': 2 }],               // custom button values
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent

        [{ 'header': [2, 3, 4, 5, 6, false] }],

        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'font': [] }],
        [{ 'align': [] }],

        ['clean']                                         // remove formatting button
    ];
    var quill = new Quill('#editor', {
    modules: {
        toolbar: toolbarOptions,
        history: {          // Enable with custom configurations
            'delay': 2500,
            'userOnly': true
        },
    },
    theme: 'snow'
    });

    quill.on('text-change', function(delta, oldDelta, source) {
            console.log(quill.container.firstChild.innerHTML)
            $('#hiddenTextArea').val(quill.container.firstChild.innerHTML);
    });
</script>
@endsection

