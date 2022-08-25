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

    <form  method="POST" action="{{route('blog.post.update', ['post' => $post])}}" enctype="multipart/form-data">
        @csrf
    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="mb-1 col-12 text-end">
                    <strong>Data de Atualização: </strong>{{date('d/m/Y H:i', strtotime($post->dh_atualizado))}}
                </div>
                <div class="mb-1 col-12">
                    <label class="form-label">Título</label>
                    <input type="text" class="form-control" name="tx_titulo" placeholder="Título" value="{{$post->tx_titulo}}" required />
                </div>
                <div class="col-md-12 mb-1">
                    <label class="form-label" >Categoria</label>
                    <select class="select2 form-select" id="select-cat" name="select_categoria" required data-placeholder="Selecione">
                        <option>Selecione</option>
                        @foreach ($categorias as $categoria)
                            <option {{$post->fk_id_categoria == $categoria->id_blog_categoria ? 'selected' : ''}} value="{{$categoria->id_blog_categoria}}">{{$categoria->tx_blog_categoria}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-1 col-12 mb-5 pb-3">
                    <label class="form-label">Texto</label>
                    <div id="editor" >
                        {!!$post->tx_conteudo!!}
                    </div>
                    <textarea name="tx_conteudo" hidden id="hiddenTextArea">{{$post->tx_conteudo}}</textarea>
                </div>
                <div class="mb-1 col-12">
                    <div class="d-flex flex-column">
                        <label class="form-check-label mb-50">Publicado</label>
                        <div class="form-check form-check-success form-switch">
                            <input type="checkbox"  class="form-check-input" id="customSwitch4"
                                name="st_publicado" {{$post->st_publicado == 'ATIVO' ? 'checked' : '' }} />
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
                                    <span class="card-newthumb dz-preview dz-processing dz-image-preview dz-error dz-complete" data-uploadname="eles.jpg">
                                        <div class="dz-image">
                                            <img src="{{ url('imagens/blog/'.$post->tx_imagem)}}">
                                        </div>
                                        <div class="dz-details">
                                            <div class="dz-size"><span><strong>{{floor(filesize( 'imagens/blog/'.$post->tx_imagem ) / 1024)}}</strong> KB</span></div>
                                            <div class="dz-filename"><span>{{ $post->tx_imagem}}</span></div>
                                        </div>
                                        <a href="#" class="btn btn-outline-danger btn-sm justCreatedCard w-100" onclick="removeOne(event)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>
                                    </span>

                                </div>
                                  <label class="custom-file-label" for="files">
                                    <div class="dz-message " id="dz-message">Clique aqui ou arraste a imagem.</div>
                                </label>
                                <div class="col-lg-12">
                                  <div class="input-group">
                                    <div class="custom-file">
                                      <input type="file" class="custom-images-input" id="files" name="tx_imagem"
                                      hidden width=1440 height=500 filesize=1500 value="{{$post->tx_imagem}}">
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
                    <button type="submit" class="btn btn-success data-submit me-1">Editar</button>
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

