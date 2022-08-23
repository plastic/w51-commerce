@extends('layouts/contentLayoutMaster')

@section('title', 'Produto')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/file-uploaders/dropzone.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
@endsection
@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-file-uploader.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
    {{-- <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-departamentos.css')) }}"> --}}
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

    <form  method="POST" action="{{route('produto.store')}}" enctype="multipart/form-data">
        @csrf




            <section class="horizontal-wizard">
                <div class="bs-stepper horizontal-wizard-example">
                  <div class="bs-stepper-header" role="tablist">
                    <div class="step" data-target="#account-details" role="tab" id="account-details-trigger">
                      <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">1</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Detalhes</span>
                            <span class="bs-stepper-subtitle">Informações gerais</span>
                        </span>
                      </button>
                    </div>
                    <div class="line">
                      <i data-feather="chevron-right" class="font-medium-2"></i>
                    </div>
                    <div class="step" data-target="#personal-info" role="tab" id="personal-info-trigger">
                      <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">2</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Variações</span>
                            <span class="bs-stepper-subtitle">Produtos X</span>
                        </span>
                      </button>
                    </div>


                  </div>
                  <div class="bs-stepper-content">
                    <div id="account-details" class="content" role="tabpanel" aria-labelledby="account-details-trigger">

                      <form>
                        <div class="row">

                            <div class="mb-1 col-12">
                                <label class="form-label">Nome do produto</label>
                                <input type="text" class="form-control" name="tx_categoria" placeholder="Nome" required />
                            </div>

                            <div class="mb-1 col-12">
                                <label class="form-label">Descrição</label>
                                <textarea class="form-control" name="tx_descricao" placeholder="Descrição..." required> </textarea>
                                {{-- <div id="snow-wrapper">
                                    <div id="snow-container">
                                      <div class="quill-toolbar">
                                        <span class="ql-formats">
                                          <select class="ql-header">
                                            <option value="1">Heading</option>
                                            <option value="2">Subheading</option>
                                            <option selected>Normal</option>
                                          </select>
                                          <select class="ql-font">
                                            <option selected>Sailec Light</option>
                                            <option value="sofia">Sofia Pro</option>
                                            <option value="slabo">Slabo 27px</option>
                                            <option value="roboto">Roboto Slab</option>
                                            <option value="inconsolata">Inconsolata</option>
                                            <option value="ubuntu">Ubuntu Mono</option>
                                          </select>
                                        </span>
                                        <span class="ql-formats">
                                          <button class="ql-bold"></button>
                                          <button class="ql-italic"></button>
                                          <button class="ql-underline"></button>
                                        </span>
                                        <span class="ql-formats">
                                          <button class="ql-list" value="ordered"></button>
                                          <button class="ql-list" value="bullet"></button>
                                        </span>
                                        <span class="ql-formats">
                                          <button class="ql-link"></button>
                                          <button class="ql-image"></button>
                                          <button class="ql-video"></button>
                                        </span>
                                        <span class="ql-formats">
                                          <button class="ql-formula"></button>
                                          <button class="ql-code-block"></button>
                                        </span>
                                        <span class="ql-formats">
                                          <button class="ql-clean"></button>
                                        </span>
                                      </div>
                                      <div id="editor">

                                      </div>
                                    </div>
                                  </div> --}}
                            </div>

                        </div>


                        <hr class="my-2">

                        <div class="row">

                            <div class="mb-1 col-2">
                                <div class="d-flex flex-column">
                                    <label class="form-check-label mb-50">Tipo de produto</label>
                                    <div class="demo-inline-spacing">
                                        <div class="form-check form-check-inline mt-0">
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              name="inlineRadioOptions"
                                              id="inlineRadio1"
                                              value="option1"
                                              checked
                                            />
                                            <label class="form-check-label" for="inlineRadio1">Físico</label>
                                          </div>
                                          <div class="form-check form-check-inline mt-0">
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              name="inlineRadioOptions"
                                              id="inlineRadio2"
                                              value="option2"
                                            />
                                            <label class="form-check-label" for="inlineRadio2">Virtual</label>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="mb-1 col-2">
                                <div class="d-flex flex-column">
                                    <label class="form-check-label mb-50">Produto com variação</label>
                                    <div class="form-check form-check-success form-switch">
                                        <input type="checkbox"  class="form-check-input" id="customSwitch4"
                                            name="st_publicado" />
                                    </div>
                                </div>
                            </div>


                            <div class="mb-1 col-2">
                                <div class="d-flex flex-column">
                                    <label class="form-check-label mb-50">Produto em destaque</label>
                                    <div class="form-check form-check-success form-switch">
                                        <input type="checkbox"  class="form-check-input" id="customSwitch4"
                                            name="st_publicado" />
                                    </div>
                                </div>
                            </div>
                            <div class="mb-1 col-2">
                                <div class="d-flex flex-column">
                                    <label class="form-check-label mb-50">Publicado</label>
                                    <div class="form-check form-check-success form-switch">
                                        <input type="checkbox" checked class="form-check-input" id="customSwitch4"
                                            name="st_publicado" />
                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr class="my-3">

                        <div class="row">
                            <div class="col-12">

                                    <h4 class="card-title">Imagens do produto</h4>

                                    <p class="card-text">
                                      Esse banner sera exibido na página do departamento <code>1440x500 | jpg.png</code>
                                    </p>


                                       <div id="actions" class="dropzone dropzone-area">
                                            <div  id="allImagesWrapper" class="col-lg-12 d-flex actions">

                                            </div>
                                              <label class="custom-file-label" for="files">
                                                <div class="dz-message " id="dz-message">Clique aqui ou arraste o banner.</div>
                                            </label>
                                            <div class="col-lg-12">
                                              <div class="input-group">
                                                <div class="custom-file">
                                                  <input type="file" class="custom-images-input" id="files" name="banner[]"
                                                  hidden multiple  filesize=1500>
                                                </div>
                                              </div>
                                            </div>
                                          </div>


                              </div>
                              <div class="col-12 mt-2">
                                <label class="form-check-label mb-50">Vídeo do produto</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i data-feather='youtube'></i></span>
                                    <input type="text" class="form-control" name="tx_video" placeholder="Ex. https://www.youtube.com/watch?v=000" required />
                                </div>

                              </div>
                        </div>

                        <hr class="my-2">

                        <div class="row">
                         <h4 class="card-title">Preços</h4>

                          <div class="mb-1  col-md-3">
                            <label class="form-check-label mb-50">Preço de custo</label>
                            <div class="input-group">
                                <span class="input-group-text">R$</span>
                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-text">.00</span>
                              </div>
                          </div>
                          <div class="mb-1  col-md-3">
                            <label class="form-check-label mb-50">Preço de venda (preço de)</label>
                            <div class="input-group">
                                <span class="input-group-text">R$</span>
                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-text">.00</span>
                              </div>
                          </div>
                          <div class="mb-1 col-md-3">
                            <label class="form-check-label mb-50">Preço promocional (preço por)</label>
                            <div class="input-group">
                                <span class="input-group-text">R$</span>
                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-text">.00</span>
                              </div>
                          </div>

                        </div>


                        <hr class="my-2">

                        <div class="row">
                         <h4 class="card-title">Estoque</h4>

                            <div class="mb-1 col-2">
                                <div class="d-flex flex-column">
                                    <label class="form-check-label mb-50">Venda ilimitada</label>
                                    <div class="form-check form-check-success form-switch">
                                        <input type="checkbox"  class="form-check-input" id="customSwitch4"
                                            name="st_publicado" />
                                    </div>
                                </div>
                            </div>

                          <div class="mb-1  col-md-2">
                            <label class="form-check-label mb-50">Quantide</label>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                          </div>
                          <div class="mb-1  col-md-3">
                            <label class="form-check-label mb-50">SKU (Unidade de manutenção de estoque)</label>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                          </div>
                          <div class="mb-1 col-md-3">
                            <label class="form-check-label mb-50">Código de barras (GTIN, EAN, ISBN, etc.)</label>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                          </div>

                        </div>


                        <hr class="my-2">

                        <div class="row">
                         <h4 class="card-title">Peso e dimensões</h4>

                          <div class="mb-1  col-md-2">
                            <label class="form-check-label mb-50">Peso</label>
                            <div class="input-group mb-4">
                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-text">Kg</span>
                              </div>
                          </div>
                          <div class="mb-1  col-md-2">
                            <label class="form-check-label mb-50">Altura</label>
                            <div class="input-group mb-4">
                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-text">cm</span>
                              </div>
                          </div>
                          <div class="mb-1 col-md-2">
                            <label class="form-check-label mb-50">Largura</label>
                            <div class="input-group mb-4">
                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-text">cm</span>
                              </div>
                          </div>
                          <div class="mb-1 col-md-2">
                            <label class="form-check-label mb-50">Profundidade</label>
                            <div class="input-group mb-4">
                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-text">cm</span>
                              </div>
                          </div>

                        </div>


                      </form>
                      <div class="d-flex justify-content-between">
                        <button class="btn btn-outline-secondary btn-prev" disabled>
                          <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                          <span class="align-middle d-sm-inline-block d-none">Detalhes</span>
                        </button>
                        <button class="btn btn-primary btn-next">
                          <span class="align-middle d-sm-inline-block d-none">Variações</span>
                          <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                        </button>
                      </div>
                    </div>
                    <div id="personal-info" class="content" role="tabpanel" aria-labelledby="personal-info-trigger">

                      <form>
                        <div class="row">
                          <div class="mb-1 col-md-6">
                            <label class="form-label" for="first-name">First Name</label>
                            <input type="text" name="first-name" id="first-name" class="form-control" placeholder="John" />
                          </div>
                          <div class="mb-1 col-md-6">
                            <label class="form-label" for="last-name">Last Name</label>
                            <input type="text" name="last-name" id="last-name" class="form-control" placeholder="Doe" />
                          </div>
                        </div>
                        <div class="row">
                          <div class="mb-1 col-md-6">
                            <label class="form-label" for="country">Country</label>
                            <select class="select2 w-100" name="country" id="country">
                              <option label=" "></option>
                              <option>UK</option>
                              <option>USA</option>
                              <option>Spain</option>
                              <option>France</option>
                              <option>Italy</option>
                              <option>Australia</option>
                            </select>
                          </div>
                          <div class="mb-1 col-md-6">
                            <label class="form-label" for="language">Language</label>
                            <select class="select2 w-100" name="language" id="language" multiple>
                              <option>English</option>
                              <option>French</option>
                              <option>Spanish</option>
                            </select>
                          </div>
                        </div>
                      </form>
                      <div class="d-flex justify-content-between">
                        <button class="btn btn-primary btn-prev">
                          <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                          <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>
                        <button class="btn btn-primary btn-next">
                          <span class="align-middle d-sm-inline-block d-none">Next</span>
                          <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                        </button>
                      </div>
                    </div>


                  </div>
                </div>
              </section>
              <!-- /Horizontal Wizard -->


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
    <script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/forms/form-file-uploader.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-wizard.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-quill-editor.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-images.js')) }}"></script>

<script>
    var quill = new Quill('#editor', {
    modules: {
        toolbar: '#toolbar'
    },
    theme: 'snow'
    });
</script>

@endsection
